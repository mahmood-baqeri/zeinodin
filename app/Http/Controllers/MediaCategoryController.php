<?php

namespace App\Http\Controllers;

use App\MediaCategory;
use Illuminate\Http\Request;

class MediaCategoryController extends Controller
{

    public function messages()
    {
        return [
            'name.required' => 'عنوان را وارد کنید.',
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = MediaCategory::latest()->get();
        return view('admin.mediaCategory.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = MediaCategory::all();
        return view('admin.mediaCategory.new', compact('category'));
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


            MediaCategory::create($request->all());
            return redirect()->back()->with('success', 'آلبوم جدید با موفقیت ایجاد گردید');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\MediaCategory $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function show(MediaCategory $mediaCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\MediaCategory $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(MediaCategory $mediaCategory)
    {
        $category = MediaCategory::all();
        return view('admin.mediaCategory.edit', compact('mediaCategory', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaCategory $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MediaCategory $mediaCategory)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            if ($request->hasFile('file')) {
                if (file_exists($mediaCategory->photo)){
                    unlink($mediaCategory->photo);
                }
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo']  = $destinationPath.$file_name;
            }


            $mediaCategory->update($request->all());
            return redirect()->back()->with('success', 'آلبوم  با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\MediaCategory $mediaCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MediaCategory::destroy($id);
        return redirect()->back()->with('success', 'آلبوم با موفقیت حذف گردید');
    }
}
