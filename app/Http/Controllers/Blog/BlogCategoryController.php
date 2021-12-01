<?php

namespace App\Http\Controllers\Blog;

use App\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{

    public function messages()
    {
        return [
            'text.required' => 'متن را وارد کنید.',
            'file.max' => ' حداکثر حجم فایل 10 مگ است.',
            'file.mimes' => 'فرمت عکس نامعتبر می باشد. (jpeg,jpg,png)',
            'title.required' => 'عنوان را وارد کنید.',
            'code.required' => 'کد تخفیف را وارد کنید.',

            'name.required' => 'عنوان را وارد کنید.',
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
        $all = BlogCategory::latest()->get();
        return view('admin.blogCategory.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = BlogCategory::all();
        return view('admin.blogCategory.new', compact('category'));
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
            'metaKeywords' => 'required',
            'metaDescription' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            $count = BlogCategory::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            BlogCategory::create($request->all());
            return redirect()->back()->with('success', 'دسته بندی جدید با موفقیت ایجاد گردید');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogCategory $blogCategory)
    {
        $category = BlogCategory::all();
        return view('admin.blogCategory.edit', compact('blogCategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogCategory $blogCategory)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            $count = BlogCategory::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            $blogCategory->update($request->all());
            return redirect()->back()->with('success', 'دسته بندی  با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BlogCategory $blogCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BlogCategory::destroy($id);
        return redirect()->back()->with('success', 'دسته بندی با موفقیت حذف گردید');
    }
}
