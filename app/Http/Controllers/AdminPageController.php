<?php

namespace App\Http\Controllers;

use App\About;
use App\Contact;
use App\Customer;
use App\Menu;
use App\Page;
use App\Site;
use App\Slider;
use App\UserAbout;
use Verta;
use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    //
    public function messages(){
        return [
            'text.required' => 'متن را وارد کنید.',
            'summer.required' => 'خلاصه را وارد کنید.',
            'file.max'      => ' حداکثر حجم فایل 10 مگ است.',
            'file.mimes'      => 'فرمت عکس نامعتبر می باشد. (jpeg,jpg,png)',

            'name_site.required' => 'نام سایت را وارد کنید.',
            'length.required' => 'طول جغرافیایی را وارد کنید.',
            'width.required' => 'عرض جغرافیایی را وارد کنید.',


            'title.required' => 'عنوان را وارد کنید.',
            'title_edit.required' => 'عنوان را وارد کنید.',
            'link.regex'    => 'لینک را به درستی وارد کنید. (www.address_link.com)',
            'text.required_if' =>'در صورت انتخاب وضعیت فعال، متن را وارد کنید.',

            'name.required' =>'نام را وارد کنید.',
            'menu_id.required' =>'منو مورد نظر را انتخاب کنید.',


        ];
    }

    public function edit_about(Request $request){
        $validator = \Validator::make($request->all(), [
            'text' => 'required',
            'summer' => 'required',
            'file' => 'max:10240',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $about = About::where('id' , '1')->first();
            if ($about->update($request->all())){
                $file_upload = edit_upload_file($request, $about->img, 'page/about', 'file');
                $about->img = $file_upload;
                $about->update();
            }
        }
        return response()->json(['success'=>'با موفقیت ذخیره شد.']);
    }

    public function edit_guide(Request $request){
        $validator = \Validator::make($request->all(), [
            'text' => 'required',
            'file' => 'max:10240',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $about = About::findOrFail(2);
            if ($about->update($request->all())){
                $file_upload = edit_upload_file($request, $about->img, 'page/about', 'file');
                $about->img = $file_upload;
                $about->update();
            }
        }
        return response()->json(['success'=>'با موفقیت ذخیره شد.']);
    }

    public function edit_contact(Request $request){
        $validator = \Validator::make($request->all(), [
            'name_site' => 'required',
            'file' => 'max:10240',
            'length' => 'required',
            'width' => 'required',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $contact = Contact::where('id' , '1')->first();
            if($contact->update($request->all())){
                $file_upload = edit_upload_file($request, $contact->logo, 'page/contacts', 'file');
                $contact->logo = $file_upload;
                $contact->update();
            }
        }
        return response()->json(['success'=>'با موفقیت ذخیره شد.']);
    }

    public function insert_customer(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $customer = new Customer($request->all());
            if($customer->save()){
                $file_upload = upload_file($request, "page/customer", 'file');
                $customer->img = $file_upload;
                $customer->save();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_show_customer(Request $request){
        $output = "";
        $customer = Customer::where('id', $request->id)->first();
        if($customer->img != 'image.png') $src =  "../../../image/page/customer/$customer->img"; else $src ="../../../image/page/$customer->img";
            $output = "<div class=\"col-sm-3 pull-left\">
                        <div class=\"pull-left\" id=\"image_upload\">
                            <label for=\"file_edit\">
                                <input type=\"file\" name=\"file\" id=\"file_edit\" style=\"display:none;\" onchange=\"readURLEdit(this);\"/>
                                <img  id=\"blah_edit\" class=\"img-thumbnail img-responsive\" src='$src'>
                            </label>
                        </div>
                    </div><div class=\"col-sm-9 pull-right\">
                        <div class=\"row\">
                            <div class=\"col-25\">
                                <label>عنوان<span style=\"color: red\">*</span>  </label>
                            </div>
                            <div class=\"col-75\">
                                <input type=\"text\" id=\"title_edit\" value='$customer->title'>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-25\">
                                <label>لینک</label>
                            </div>
                            <div class=\"col-75\">
                                <input type=\"text\" id=\"link_edit\" value='$customer->link'>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\" id=\"btn\">
                        <a class=\"btn insert_form\" onclick=\"edit_customer($customer->id)\" href=\"#\">  <i class=\"fa fa-plus\"></i>   ثبت اطلاعات </a>&nbsp;
                    </div>
                    ";
        return Response()->json($output);
    }

    public function edit_customer(Request $request){
        $validator = \Validator::make($request->all(), [
            'title_edit' => 'required',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $customer = Customer::where('id', $request->id)->first();
            $customer->title = $request->title_edit;
            $customer->link = $request->link_edit;
            if($customer->update()){
                $file_upload = edit_upload_file($request, $customer->img, 'page/customer', 'file_edit');
                $customer->img = $file_upload;
                $customer->update();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_customer(Request $request){
        $id = $request->id;
        $customer = Customer::where('id', $id)->first();
        remove_file($customer->img, 'page/customer');
        $customer_del = Customer::where('id', $id)->delete();
        return response()->json($customer_del);
    }

    public function insert_menu(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'file' => 'max:10240',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $menu = new Menu($request->all());
            $menu->url = get_url($menu->name);
            if ($menu->save($request->all())) {
                $file_upload = upload_file($request, "page/menu", 'file');
                $menu->img = $file_upload;
                $menu->save();
            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_show_menu(Request $request){
        $output = "";
        $menu = Menu::where('id' , $request->menu_id)->first();
        if($menu->img != 'image.png') $src =  "../../../image/page/menu/$menu->img"; else $src ="../../../image/page/$menu->img";

        $cat_parent = Menu::where('id' , $menu->parent_id)->first();
        $cats = Menu::where([['id' , '!=' ,  $menu->id] , ['parent_id' , '==' , '0']])->orderby('id' , 'desc')->get();
        if ($menu){
            $output .= "<hr><div class=\"row\">
                            <div class=\"col-25\">
                                <label>نام منو</label>
                            </div>
                            <div class=\"col-75\">
                                <input type=\"text\" id=\"name_edit\" value='$menu->name'>
                            </div>
                        </div>

                        <div class=\"row\">
                            <div class=\"col-25\">
                                <label>انتخاب دسته </label>
                            </div>
                            <div class=\"col-75\">
                                <select id=\"parent_id_edit\" >";
                                if($menu->parent_id == '0')
                                    $output .="<option class='selected' value=\"0\">دسته اصلی</option>";else{
                                    $output .="<option class='selected' value=\"$cat_parent->id\">$cat_parent->name</option><option value=\"0\">دسته اصلی</option>";}
                                foreach ($cats as $cats1){
                                    $output .="<option value=\"$cats1->id\" >$cats1->name</option>";}
                                $output .="</select>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col - 25\">
                                <label> تصویر</label>
                            </div>
                            <div class=\"col-25\" id='image_upload'>
                                <label for='file_edit'>
                                    <input type=\"file\" id=\"file_edit\" style=\"display:none;\" onchange=\"readURLEdit(this);\" />
                                    <img  id=\"blah_edit\" title=\"انتخاب عکس\" class=\"img-thumbnail img-responsive\" src='$src'>
                                </label>
                            </div>
                        </div>
                        <div >
                            <a class=\"btn insert_form\" onclick=\"edit_menu('$menu->id')\">  <i class=\"fa fa-edit\"></i>   ویرایش </a>&nbsp;
                        </div>";

            return Response(['success'=>$output]);
        }else{
            return Response(['error'=>""]);
        }
    }

    public function edit_menu(Request $request){
        $id = $request->id;
        $menu = Menu::where('id', $id)->first();
        $menu->url = get_url($request->name_edit);
        $menu->parent_id = $request->parent_id_edit;
        $menu->name = $request->name_edit;
        if($menu->update()){
            $file_upload = edit_upload_file($request, $menu->img, 'page/menu', 'file_edit');
            $menu->img = $file_upload;
            $menu->update();
        }
        return response()->json(['success' => 'با موفقیت ذخیره شد.']);
    }

    public function delete_menu(Request $request){
        $id = $request->id;
        $menu = Menu::where('id' , $id)->first();
        remove_file($menu->img, 'page/menu');
        $delete_menu = Menu::where('id' , $id)->delete();
        $menu_parent = Menu::where('parent_id' , $id)->get();
        foreach ($menu_parent as $value){
            remove_file($value->img, 'page/menu');
        }
        $menu_parent = Menu::where('parent_id' , $id)->delete();
        $page = Page::where('menu_id' , $id)->get();
        foreach ($page as $value){
            remove_file($value->img, 'page/main');
        }
        $page = Page::where('menu_id' , $id)->delete();
        return response()->json($delete_menu);
    }

    public function insert_page(Request $request){
        $validator = \Validator::make($request->all(), [
            'menu_id' => 'integer',
            'title' => 'required',
//            'text' => 'required_if:status,1',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $page = new Page($request->all());
            $v = new Verta();
            $page->date = $v->formatJalaliDate();
            $page->url = get_url($page->title);

            if ($page->save()){
                $file_upload = upload_file($request, "page/main", 'file');
                $page->img = $file_upload;
                $page->save();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_page(Request $request){
        $validator = \Validator::make($request->all(), [
            'menu_id' => 'integer',
            'title' => 'required',
//            'text' => 'required_if:status,1',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $id = $request->id;
            $page = Page::where('id' , $id)->first();
            $page->url = get_url($request->title);
            if($page->update($request->all())){
                $file_upload = edit_upload_file($request, $page->img, 'page/main', 'file');
                $page->img = $file_upload;
                $page->update();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_page(Request $request){
        $id = $request->id;
        $page = Page::where('id' , $id)->first();
        remove_file($page->img, 'page/main');
        $page = Page::where('id' , $id)->delete();
        return response()->json($page);
    }

    public function insert_slider(Request $request){
        $validator = \Validator::make($request->all(), [
            'file' => 'max:10240',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $slider = new Slider($request->all());
            $slider->url = get_url($request->title);
            if ($slider->save()) {
                $file_upload = upload_file($request, "page/slider", 'file');
                $slider->img = $file_upload;
                $slider->save();
            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_slider(Request $request){
        $validator = \Validator::make($request->all(), [
            // 'link' => 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'file' => 'max:10240',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $id = $request->id;
            $slider = Slider::where('id' , $id)->first();
            $slider->url = get_url($request->title);
            if ($slider->update($request->all())){
                $file_upload = edit_upload_file($request, $slider->img, 'page/slider', 'file');
                $slider->img = $file_upload;
                $slider->update();
            }
        }
        return response()->json(['success'=>'با موفقیت ذخیره شد.']);
    }

    public function delete_slider(Request $request){
        $id = $request->id;
        $slider = Slider::where('id' , $id)->first();
        remove_file($slider->img, 'page/slider');
        $slider_del = Slider::where('id' , $id)->delete();
        return response()->json($slider_del);

    }

    public function insert_site(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $site = new Site($request->all());

            if ($site->save()){
                $file_upload = upload_file($request, "page/site", 'file');
                $site->img = $file_upload;
                $site->save();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_site(Request $request){
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $id = $request->id;
            $site = Site::where('id' , $id)->first();
            if($site->update($request->all())){
                $file_upload = edit_upload_file($request, $site->img, 'page/site', 'file');
                $site->img = $file_upload;
                $site->update();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_site(Request $request){
        $id = $request->id;
        $page = Site::where('id' , $id)->first();
        remove_file($page->img, 'page/site');
        $page = Site::where('id' , $id)->delete();
        return response()->json($page);
    }

    public function insert_user_about(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $user_about = new UserAbout($request->all());
            if($user_about->save()){
                $file_upload = upload_file($request, "page/about", 'file');
                $user_about->img = $file_upload;
                $user_about->save();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_show_user_about(Request $request){
        $output = "";
        $user_about = UserAbout::where('id', $request->id)->first();
        if($user_about->img != 'image.png') $src =  "../../../image/page/about/$user_about->img"; else $src ="../../../image/page/$user_about->img";
        $output = "<div class=\"col-sm-3 pull-left\">
                        <div class=\"pull-left\" id=\"image_upload\">
                            <label for=\"file_edit\">
                                <input type=\"file\" name=\"file\" id=\"file_edit\" style=\"display:none;\" onchange=\"readURLEdit(this);\"/>
                                <img  id=\"blah_edit\" class=\"img-thumbnail img-responsive\" src='$src'>
                            </label>
                        </div>
                    </div>
                    <div class=\"col-sm-9 pull-right\">
                        <div class=\"row\">
                            <div class=\"col-25\">
                                <label>نام و نام خانوادگی<span style=\"color: red\">*</span>  </label>
                            </div>
                            <div class=\"col-75\">
                                <input type=\"text\" id=\"name_edit\" value='$user_about->name'>
                            </div>
                        </div>
                       <div class=\"row\">
                            <div class=\"col-25\">
                                <label>&#1593;&#1606;&#1608;&#1575;&#1606; &#1588;&#1594;&#1604;&#1740;<span style=\"color: red\">*</span>  </label>
                            </div>
                            <div class=\"col-75\">
                                <input type=\"text\" id=\"title_edit\" value='$user_about->title'>
                            </div>
                        </div>
                        <div class=\"row\">
                            <div class=\"col-25\">
                                <label>&#1585;&#1586;&#1608;&#1605;&#1607;</label>
                            </div>
                            <div class=\"col-75\">
                                <textarea id=\"detail_edit\">$user_about->detail</textarea>
                            </div>
                        </div>
                    </div>


                    <div class=\"row\" id=\"btn\">
                        <a class=\"btn insert_form\" onclick=\"edit_user_about($user_about->id)\" href=\"#\">  <i class=\"fa fa-plus\"></i>   ثبت اطلاعات </a>&nbsp;
                    </div>
                    ";
        return Response()->json($output);
    }

    public function edit_user_about(Request $request){
        $validator = \Validator::make($request->all(), [
            'name_edit' => 'required',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $user_about = UserAbout::where('id', $request->id)->first();
            $user_about->name = $request->name_edit;
            $user_about->title= $request->title_edit;
            $user_about->detail = $request->detail_edit;
            if($user_about->update()){
                $file_upload = edit_upload_file($request, $user_about->img, 'page/about', 'file_edit');
                $user_about->img = $file_upload;
                $user_about->update();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_user_about(Request $request){
        $id = $request->id;
        $user_about = UserAbout::where('id', $id)->first();
        remove_file($user_about->img, 'page/about');
        $user_about_del = UserAbout::where('id', $id)->delete();
        return response()->json($user_about_del);
    }
}
