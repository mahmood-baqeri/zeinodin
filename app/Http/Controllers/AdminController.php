<?php

namespace App\Http\Controllers;

use App\About;
use App\CategoryUsers;
use App\Contact;
use App\ContactForm;
use App\Course;
use App\Customer;
use App\Discount;
use App\File;
use App\InsertCourse;
use App\Menu;
use App\Page;
use App\Site;
use App\Slider;
use App\User;
use App\UserAbout;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function messages()
    {
        return [
            'name.required' => 'عنوان را وارد کنید.',
            'summer.required' => 'خلاصه را وارد کنید.',
            'description.required' => 'متن کامل را وارد کنید.',
            'file.required' => 'تصویر را وارد کنید.',
            'metaKeywords.required' => 'متای کلمات را وارد کنید.',
            'metaDescription.required' => 'متای توضیحات را وارد کنید.',
        ];
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('role', '2')->get();
        $course = Course::get();
        $id_new = Menu::where('name', 'اخبار')->first();
        $news = Page::where(['menu_id' => $id_new, 'deleted_at' => NULL])->get();
        return view('admin/index', ['user' => $user, 'course' => $course, 'news' => $news]);
    }

//    User
    public function index_user($role)
    {
        $user = User::where('role', $role)->orderby('position', 'asc')->get();
        return view('admin/user/index', ['role' => $role, 'user' => $user]);
    }

    public function insert_user($role)
    {
        $category_user = CategoryUsers::get();
        return view('admin/user/insert', ['role' => $role, 'category_user' => $category_user]);
    }

    public function edit_user($id, $role)
    {
        $user = User::where('id', $id)->first();
        $catList = CategoryUsers::getCat();
//        $catList=Menu::get_parent();
        return view('admin/user/edit', ['role' => $role, 'data' => $user, 'catList' => $catList]);
    }

    public function contact_user()
    {
        $contact = ContactForm::orderby('id', 'desc')->get();
        return view('admin/contactUser', ['contact' => $contact]);
    }

//    course
    public function index_events()
    {
        $course = Course::orderby('id', 'desc')->get();
        return view('admin/course/index', ['course' => $course]);
    }

    public function insert_events(Request $request)
    {
        $user = User::get_user($request->all());
        return view('admin/course/insert', ['user' => $user]);
    }

    public function edit_events(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();
        $user = User::get_user($request->all());
        return view('admin/course/edit', ['data' => $course, 'user' => $user]);
    }

    public function discount()
    {
        $discount = Discount::orderby('id', 'desc')->get();
        return view('admin/course/discount', ['discount' => $discount]);
    }

    public function list_user($id, $type)
    {
        if ($id == '0') {
            $course = InsertCourse::orderby('id', 'desc')->get();
        } else {
            $course = InsertCourse::where('course_id', $id)->orderby('id', 'desc')->get();


//            if ($type = 0) {
//                $course = InsertCourse::where('course_id', $id)->orderby('id', 'desc')->get();
//            }
//            elseif ($type = 1) {
//                $course = InsertCourse::where('slider_id', $id)->orderby('id', 'desc')->get();
//            }
        }
        return view('admin/course/listUser', ['course' => $course]);
    }

    //    site
    public function index_site()
    {
        $site = Site::orderby('id', 'desc')->get();
        return view('admin/page/site/index', ['site' => $site]);
    }

    public function insert_site(Request $request)
    {
        return view('admin/page/site/insert');
    }

    public function edit_site(Request $request, $id)
    {
        $site = Site::where('id', $id)->first();
        return view('admin/page/site/edit', ['data' => $site]);
    }

//    menu
    public function page_menu(Request $request)
    {
        $menu = Menu::get_parent($request->all());
        $all_menu = Menu::get_menu($request->all());
        return view('admin.page.menu', ['menu' => $menu, 'all_menu' => $all_menu]);
    }

//    page
    public function page_about()
    {
        //m   درباره بنیاد
        $about = About::where('type' , 0)->first();
        return view('admin.page.about', ['data' => $about]);
    }

    public function page_vision()
    {
        //m   چشم انداز
        $vision = About::where('type' , 1)->first();
        return view('admin.page.vision', ['data' => $vision]);
    }

    public function page_statute()
    {
        //m   اساس نامه
        $vision = About::where('type' , 4)->first();
        return view('admin.page.statute', ['data' => $vision]);
    }

    public function page_mission()
    {
        //m   ماموریت
        $mission = About::where('type' , 2)->first();
        return view('admin.page.mission', ['data' => $mission]);
    }


    public function pageUpdate(Request $request , $id)
    {
        $validator = \Validator::make($request->all(), [
            'text' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['img']  = $destinationPath.$file_name;
            }

            About::find($id)->update($request->all());

            return redirect()->back()->with('success', 'عملیات با موفقیت انجام شد');
        }

    }


    public function page_guide()
    {
        //m   راهنمای وبینار
        $guide = About::where('type' , 5)->first();
        return view('admin.page.guide', ['data' => $guide]);
    }

    public function page_about_user()
    {
        $about_user = UserAbout::orderby('id', 'desc')->get();
        return view('admin.page.about_user', ['about_user' => $about_user]);
    }

    public function page_contact()
    {
        $contact = Contact::first();
        return view('admin.page.contact', ['data' => $contact]);
    }

    public function page_customer()
    {
        $customer = Customer::orderby('id', 'desc')->get();
        return view('admin.page.customer', ['customer' => $customer]);
    }

    public function index_page()
    {
        $page = Page::orderby('id', 'desc')->get();
        return view('admin/page/index', ['page' => $page]);
    }

    public function insert_page(Request $request)
    {
        $menu = Menu::get_menu($request->all());
        return view('admin/page/insert', ['menu' => $menu]);
    }

    public function edit_page($id, Request $request)
    {
        $data = Page::where('id', $id)->first();
        $menu = Menu::get_menu($request->all());
        return view('admin/page/edit', ['data' => $data, 'menu' => $menu]);
    }

    public function index_slider()
    {
        $slider = Slider::orderby('id', 'desc')->get();
        return view('admin/page/slider/index', ['slider' => $slider]);
    }

    public function insert_slider(Request $request)
    {
        return view('admin/page/slider/insert');
    }

    public function edit_slider($id)
    {
        $data = Slider::where('id', $id)->first();
        return view('admin/page/slider/edit', ['data' => $data]);
    }

    public function index_file()
    {
        $file = File::orderby('id', 'desc')->get();
        return view('admin/file/index', ['file' => $file]);
    }

    public function insert_file(Request $request)
    {
        return view('admin/file/insert');
    }
}
