<?php

namespace App\Http\Controllers;

use App\About;
use App\Biography;
use App\Blog;
use App\BlogCategory;
use App\BoniadNews;
use App\Contact;
use App\Course;
use App\Customer;
use App\Media;
use App\Menu;
use App\Page;
use App\Product;
use App\Site;
use App\Slider;
use App\User;
use App\UserAbout;
use Illuminate\Http\Request;
use Verta;

class HomeController extends Controller
{
    public function data_all()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return ['contact_data' => $contact_data, 'menu' => $menu];
    }

    public function index(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $slider = Slider::where('status', '1')->orderby('id', 'desc')->get();
        $site = Site::where(['status' => '1'])->orderby('id', 'desc')->get();

        $boniadNewsSingle = BoniadNews::where('important', '1')->first();;
        $boniadNewsSingleId = $boniadNewsSingle ? $boniadNewsSingle->id : 0;
        $boniadNews = BoniadNews::where('id', '!=', $boniadNewsSingleId)->where('status', '1')->orderby('id', 'desc')->take(5)->get();
        if (!$boniadNewsSingle)
            $boniadNewsSingle = $boniadNews[0];

        $id_news = Menu::where('name', 'اخبار')->first();
        if ($id_news) {
            $news = Page::where(['menu_id' => $id_news->id, 'status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->get();
        } else {
            $news = 0;
        }
        $id_service = Menu::where('name', 'خدمات')->first();
        if ($id_service) {
            $service = Page::where(['menu_id' => $id_service->id, 'status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->get();
        } else {
            $service = 0;
        }
        $user = User::where([['type_user', '!=', '2'], 'role' => '2', 'status' => '1'])->orderby('position', 'asc')->get();

        $course = Course::where(['status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->take(4)->get();
        $customer = Customer::get();
        return view('index', ['menu' => $menu, 'contact_data' => $contact_data, 'slider' => $slider, 'site' => $site, 'news' => $news,
            'user' => $user, 'service' => $service, 'customer' => $customer, 'course' => $course, 'boniadNewsSingle' => $boniadNewsSingle, 'boniadNews' => $boniadNews]);
    }

    public function about()
    {
        //m   درباره بنیاد
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $about = About::where('type', 0)->first();
        return view('about', ['contact_data' => $contact_data, 'data' => $about, 'menu' => $menu]);
    }

    public function vision()
    {
        //m   چشم انداز
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $vision = About::where('type', 1)->first();

        return view('about', ['contact_data' => $contact_data, 'data' => $vision, 'menu' => $menu]);
    }

    public function mission()
    {
        //m   ماموریت
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $mission = About::where('type', 2)->first();
        return view('about', ['contact_data' => $contact_data, 'data' => $mission, 'menu' => $menu]);
    }

    public function team()
    {
        //m   اعضا
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $team = About::where('type', 3)->first();
        $user = [];
        $user['user0'] = UserAbout::where('status', 0)->orderby('id', 'desc')->get();
        $user['user1'] = UserAbout::where('status', 1)->orderby('id', 'desc')->get();
        $user['user2'] = UserAbout::where('status', 2)->orderby('id', 'desc')->get();
        $user['all'] = UserAbout::orderby('id', 'desc')->get();
        return view('team', ['contact_data' => $contact_data, 'data' => $team, 'menu' => $menu, 'user' => $user]);
    }


    public function guide()
    {
        //m   راهنمای وبینار
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $guide = About::where('type', 5)->first();
        $user = UserAbout::orderby('id', 'desc')->get();
        return view('guide', ['contact_data' => $contact_data, 'data' => $guide, 'menu' => $menu, 'user' => $user])->with('paySuccess', 'ok');
    }

    public function statute()
    {
        //m   اساس نامه
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $guide = About::where('type', 4)->first();
        $user = UserAbout::orderby('id', 'desc')->get();
        return view('statute', ['contact_data' => $contact_data, 'data' => $guide, 'menu' => $menu, 'user' => $user])->with('paySuccess', 'ok');
    }


    public function contact()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return view('contact', ['contact_data' => $contact_data, 'menu' => $menu]);
    }

    public function category($url)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $category = Menu::where('url', $url)->first();
        $category_all = Menu::where('parent_id', $category->id)->get();
        return view('category', ['contact_data' => $contact_data, 'category_all' => $category_all, 'category' => $category, 'menu' => $menu]);
    }

    public function list_user()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $user = User::where([['type_user', '!=', '2'], 'role' => '2', 'status' => '1'])->orderby('position', 'asc')->get();
        return view('list_user', ['contact_data' => $contact_data, 'menu' => $menu, 'user' => $user]);
    }

    public function consultation($id)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $user = User::where('id', $id)->first();
        return view('consultation', ['contact_data' => $contact_data, 'menu' => $menu, 'data' => $user]);
    }

    public function course()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $course = Course::where(['status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->get();
        return view('course', ['contact_data' => $contact_data, 'menu' => $menu, 'course' => $course]);
    }

    public function course_detail($url)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $course = Course::where('url', $url)->first();
        $course_user = Course::where(['user_id' => $course->user_id, 'status' => '1', 'deleted_at' => NULL, ['id', '!=', $course->id]])->orderby('id', 'desc')->get();
        $all_course = Course::where(['status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->take(10)->get();
        $v = new Verta();
        $date_day = str_replace('-', '/', $v->formatDate());
        return view('course_detail', ['contact_data' => $contact_data, 'menu' => $menu, 'course' => $course, 'all_course' => $all_course, 'course_user' => $course_user, 'date_day' => $date_day]);
    }

    public function page($url)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $slider = Slider::where('url', $url)->first();
        return view('page', ['contact_data' => $contact_data, 'menu' => $menu, 'slider' => $slider]);
    }

    public function business()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        return view('business', ['contact_data' => $contact_data, 'menu' => $menu]);
    }

    public function news($url)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $category = Menu::where('url', $url)->first();
        $category_all = Menu::where('parent_id', $category->parent_id)->get();
        $blog = Page::where('menu_id', $category->id)->orderby('id', 'desc')->get();
        $all_blog = Page::where('status', '1')->orderby('id', 'desc')->get();

        return view('news', ['contact_data' => $contact_data, 'menu' => $menu, 'category' => $category, 'category_all' => $category_all, 'blog' => $blog, 'all_blog' => $all_blog]);
    }

    public function news_detail($url)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $blog = Page::where('url', $url)->first();
        $id_news = Menu::where('name', 'اخبار')->first();
        $id_service = Menu::where('name', 'خدمات')->first();
        if ($id_news) {
            $news = Page::where(['menu_id' => $id_news->id, 'status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->get();
        } else {
            $news = 0;
        }
        $page = Page::where([['menu_id', '!=', $id_news->id], ['menu_id', '!=', $id_service->id], 'status' => '1', 'deleted_at' => NULL])->orderby('id', 'desc')->get();

        return view('news_detail', ['contact_data' => $contact_data, 'menu' => $menu, 'blog' => $blog, 'news' => $news, 'page' => $page]);
    }

    ##################################################################################################################################
    ##################################################################################################################################
    ##################################################################################################################################
    ##################################################################################################################################

    public function blog()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $blogs = Blog::where('status', '1')->orderby('id', 'desc')->get();
        return view('blog', ['contact_data' => $contact_data, 'menu' => $menu, 'blogs' => $blogs]);
    }

    public function blogCategory($slug)
    {
        $category = BlogCategory::where('slug', $slug)->first();
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $blogs = Blog::where('status', '1')->where('category_id', $category->id)->orderby('id', 'desc')->get();
        return view('blogCategory', ['contact_data' => $contact_data, 'menu' => $menu, 'blogs' => $blogs]);
    }

    public function blogSearch(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        if ($request->category_id == 0)
            $blogs = Blog::where('status', '1')->where('name', 'LIKE', '%' . $request->text . '%')->orderby('id', 'desc')->get();
        else
            $blogs = Blog::where('status', '1')->where('category_id', $request->category_id)->where('name', 'LIKE', '%' . $request->text . '%')->orderby('id', 'desc')->get();

        $searchText = $request->text;
        return view('blogSearch', ['contact_data' => $contact_data, 'menu' => $menu, 'blogs' => $blogs, 'searchText' => $searchText]);
    }

    public function blog_detail($slug)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $blog = Blog::where('slug', $slug)->first();
        return view('blog_detail', ['contact_data' => $contact_data, 'menu' => $menu, 'blog' => $blog]);
    }

    public function search(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        if ($request->type == 1)
            $all = Course::where('status', '1')
                ->where('title', 'LIKE', '%' . $request->text . '%')
                ->where('text', 'LIKE', '%' . $request->text . '%')
                ->where('text_short', 'LIKE', '%' . $request->text . '%')
                ->orderby('id', 'desc')->get();

        elseif ($request->type == 2)
            $all = Blog::where('status', '1')
                ->where('name', 'LIKE', '%' . $request->text . '%')
                ->where('summer', 'LIKE', '%' . $request->text . '%')
                ->where('description', 'LIKE', '%' . $request->text . '%')
                ->orderby('id', 'desc')->get();

        elseif ($request->type == 3)
            $all = Product::where('status', '1')
                ->where('name', 'LIKE', '%' . $request->text . '%')
                ->where('summer', 'LIKE', '%' . $request->text . '%')
                ->orderby('id', 'desc')->get();

        elseif ($request->type == 4)
            $all = Biography::where('description', 'LIKE', '%' . $request->text . '%')->get();

        elseif ($request->type == 5)
            $all = About::where('text', 'LIKE', '%' . $request->text . '%')->get();

        elseif ($request->type == 6)
            $all = Media::where('title', 'LIKE', '%' . $request->text . '%')->where('type', 1)->get();

        elseif ($request->type == 7)
            $all = Media::where('title', 'LIKE', '%' . $request->text . '%')->where('type', '!=', 1)->get();

        else
            $all = Page::where('status', '1')->where('title', 'LIKE', '%' . $request->text . '%')->orderby('id', 'desc')->get();


        $searchText = $request->text;
        $searchType = $request->type;
        return view('search', ['contact_data' => $contact_data, 'menu' => $menu, 'all' => $all, 'searchText' => $searchText, 'searchType' => $searchType]);
    }
}
