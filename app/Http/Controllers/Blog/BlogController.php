<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;


use App\Blog;
use App\BlogCategory;
use App\BlogComments;

use Auth;
use Illuminate\Http\Request;

class BlogController extends Controller
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




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Blog::latest()->get();
        return view('admin.blog.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = BlogCategory::select('id', 'name')->get();
        return view('admin.blog.new', compact( 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'summer' => 'required',
            'file' => 'required',
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo']  = $destinationPath.$file_name;
            }

            $request['user_id'] = Auth()->user()->id;
            $count = Blog::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            Blog::create($request->all());
            return redirect()->back()->with('success', 'پست  جدید با موفقیت ایجاد گردید');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::select('id', 'name')->get();
        return view('admin.blog.edit', compact('blog' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'summer' => 'required',
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {
            if ($request->hasFile('file')) {
                if (file_exists($blog->photo)){
                    unlink($blog->photo);
                }
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo']  = $destinationPath.$file_name;
            }

            $request['user_id'] = Auth()->user()->id;
            $count = Blog::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);
            $blog->update($request->all());
            return redirect()->back()->with('success', 'پست   با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        if (file_exists($blog->photo))
            unlink($blog->photo);

        $blog->delete();

        return redirect()->back()->with('success', 'پست  با موفقیت حذف گردید');
    }


    #
    #
    #
    #
    #
    #
    #
    #
    ######################################################################################
    ######################################################################################
    ######################################################################################
    ######################################################################################
    ######################################################################################
    #############################     Front

    public function all(Request $request)
    {
        $request->page ? $page = $request->page : $page = 1;

        $all = Blog::query();
        $all = $all->where('status' , 1);

        $all = $all->paginate(1, ['*'] , 'page' , $page);
        return view('front.pages.blog.all' , compact('all' , 'page'));
    }

    public function category(Request $request, $slug)
    {
        $request->page ? $page = $request->page : $page = 1;
        $category = BlogCategory::where('slug', $slug)->first();

        $all = Blog::query();
        $all = $all->where('status' , 1);

        $all = $all->where('category_id' , $category->id);

        $all = $all->paginate(30, ['*'] , 'page' , $page);
        return view('front.pages.blog.category' , compact('all' , 'page' , 'slug' , 'category'));
    }

    public function single($slug)
    {
        Blog::where('slug' , $slug)->first()->increment('see_count');
        $blog = Blog::where('slug' , $slug)->first();
        return view('front.pages.blog.single' , compact('blog'));
    }


    public function commentStore(Request $request)
    {
        if (!$request->comment)
            return ['status' => 0, 'msg' => "فیلد نظر اجباری می یاشد"];

        $parent_id = 0;
        if ($request->parent_id)
            $parent_id = $request->parent_id;

//        $user_id = null;
//        if(Auth::guard('customer')->user())
//            $user_id = Auth::guard('customer')->user()->id;

        BlogComments::create([
            'blog_id'        => $request->blog_id,
//            'user_id'        => $user_id,
            'parent_id'      => $parent_id,
            'comment'        => $request->comment,
            'status'         => 0,
            'user_name'      => $request->user_name,
            'user_mail'      => $request->user_mail,
            'cookie_key'     => $this::userCookieKey(),
        ]);

        return  ['status' => 1, 'msg' => "نظر با موفقیت ثبت گردید"];

    }



    static function userCookieKey()
    {
        $key = substr(str_shuffle('abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 1, 50);
        if (isset($_COOKIE['userCookieKey']) && $_COOKIE['userCookieKey'] != null)
            $key = json_decode($_COOKIE['userCookieKey'], true);
        else
            setcookie('userCookieKey', json_encode($key), time() + 8400000 * 10, '/');
        return $key;
    }


}
