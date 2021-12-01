<?php

namespace App\Http\Controllers\Blog;

use App\BlogComments;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class BlogCommentsController extends Controller
{

    public function messages()
    {
        return [
            'comment.required' => 'متن کامل را وارد کنید.',
            'user_name.required' => 'نام و نام خانوادگی را وارد کنید.',
            'user_mail.required' => 'ایمیل را وارد کنید.',
            'comment.required' => 'نظر را وارد کنید.',
            'adminAnswer.required' => 'متن کامل را وارد کنید.',
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = BlogComments::latest()->get();
        return view('admin.blogComments.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blogComments.new', compact('categories'));
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
            'user_name' => 'required',
            'user_mail' => 'required',
            'comment' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {
            BlogComments::create([
                'blog_id' => $request->blog_id,
                'user_name' => $request->user_name,
                'user_mail' => $request->user_mail,
                'comment' => $request->comment,
                'parent_id' => 0,
                'status' => 0,
                'user_is_admin' => 0,
            ]);
            return redirect()->back()->with('success' , 'نظر شما با موفقیت ثبت گردید بعد از تایید مدیریت فعال می گردد');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BlogComments $blogComments
     * @return \Illuminate\Http\Response
     */
    public function show(BlogComments $blogComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BlogComments $blogComments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blogComments = BlogComments::find($id);
        return view('admin.blogComments.edit', compact('blogComments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BlogComments $blogComments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blogComments = BlogComments::find($id);
        $blogComments->update($request->all());
        if ($request->adminAnswer)
            BlogComments::create([
                'cookie_key' => null,
                'blog_id' => $blogComments->blog_id,
                'user_name' => 'مدیر',
                'user_mail' => null,
                'comment' => $request->adminAnswer,
                'parent_id' => $blogComments->id,
                'status' => 1,
                'user_is_admin' => 1,
            ]);

        return redirect()->back()->with('success', 'نظر  با موفقیت بروزرسانی گردید');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BlogComments $blogComments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogComments::destroy($id);
        return redirect()->back()->with('success', 'نظر  با موفقیت حذف گردید');
    }

}
