<?php

namespace App\Http\Controllers\Product;

use App\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $all = ProductCategory::latest()->get();
        return view('admin.productCategory.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        return view('admin.productCategory.new', compact('category'));
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

            $count = ProductCategory::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            ProductCategory::create($request->all());
            return redirect()->back()->with('success', 'دسته بندی جدید با موفقیت ایجاد گردید');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        $category = ProductCategory::all();
        return view('admin.productCategory.edit', compact('productCategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            $count = ProductCategory::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            $productCategory->update($request->all());
            return redirect()->back()->with('success', 'دسته بندی  با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductCategory::destroy($id);
        return redirect()->back()->with('success', 'دسته بندی با موفقیت حذف گردید');
    }
}
