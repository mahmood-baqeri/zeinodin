<?php

namespace App\Http\Controllers;

use App\ContactForm;
use App\LevelAdmin;
use App\User;
use Verta;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function messages()
    {
        return [
            'name.required'    => 'نام را وارد کنید.',
            'last_name.required'    => 'نام خانوادگی را وارد کنید.',
            'mobile.required'    => 'تلفن همراه را وارد کنید.',
            'mobile.unique'    => 'تلفن همراه قبلا ثبت شده است.',
            'mobile.regex'    => 'تلفن همراه را به درستی وارد کنید.',
            'mobile.digits'    => 'تلفن همراه را به درستی وارد کنید.',
            'password.required'      => 'کلمه عبور را وارد کنید.',
            'password.min'      => 'حداقل تعداد کاراکتر کلمه عبور 6 می باشد.',
            'file.max'      => ' حداکثر حجم فایل 10 مگ است.',
            'file.mimes'      => 'فرمت عکس اشتباه است.',
        ];
    }

    public function insert_user(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|unique:users|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
            'password' => 'required|min:6',
            'file' => 'max:10240',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $user = new User($request->all());
            $user->password = bcrypt( $request->password );
            $v = new Verta();
            $user->date = $v->formatJalaliDatetime();
            if($user->save($request->all())){
                $file_upload = upload_file($request, "user", 'file');
                $user->img = $file_upload;
                $user->save();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_user(Request $request){
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:11',
            'file' => 'max:10240',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $id = $request->id;
            $user = User::where('id' , $id)->first();
            $user->update($request->all());
            if($user->update($request->all())){
                $file_upload = edit_upload_file($request, $user->img, 'user', 'file');
                $user->img = $file_upload;
                $user->update();
            }
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_pass(Request $request){
        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:6',
        ],$this->messages());

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
            $id = $request->id;
            $user = User::where('id' , $id)->first();
            $user->password = bcrypt( $request->password );
            $user->update();
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_user(Request $request){
        $id_user = $request->id;
        $delete_user = User::where('id' , $id_user)->delete();
        return response()->json($delete_user);
    }

    public function level_user(Request $request , $id)
    {
        if ( $request->has('level') ) {
            $delete = LevelAdmin::where('id_user',$id)->delete();
            foreach ($request->get('level') as $key => $value) {
                $level = LevelAdmin::create(['id_user'=>$id,'id_level'=>$value]);
            }
            return redirect('admin/users/admin/level');
        }else{
            $delete = LevelAdmin::where('id_user',$id)->delete();
            return redirect('admin/users/admin/level');
        }
    }

    public function delete_contact_form(Request $request){
        $id = $request->id;
        $delete = ContactForm::where('id' , $id)->delete();
        return response()->json($delete);
    }

    public function change_position(Request $request){
        $n=1;
        $id_user=str_replace('user' , '' ,$request->get('position'));
        $position=explode(',', $id_user);
        foreach($position as $key=>$value) {
            if(!empty($value)) {
                User::where('id',$value)->update(['position'=>$n]);
                $n++;
            }
        }
        return 'ok';
    }
}
