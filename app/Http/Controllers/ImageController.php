<?php

namespace App\Http\Controllers;

use App\Images;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Images::all();
        return view('admin.image.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.image.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            foreach ($images as $file) {
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                Images::create(['photo' => $destinationPath.$file_name]);
            }
        }

        return redirect()->back()->with('success', 'تصویر جدید با موفقیت ایجاد گردید');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Images  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Images $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Images  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Images $image)
    {
        return view('admin.image.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Images  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Images $image)
    {
        if ($request->hasFile('file')) {
            if (file_exists($image->photo)){
                unlink($image->photo);
            }
            $file = $request->file('file');
            $destinationPath = 'public/image/img/';
            $file_name = time() . rand(10 , 99) . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $file_name);
            $image->update(['photo' => $destinationPath.$file_name]);
            return redirect()->back()->with('success', 'تصویر جدید با موفقیت بروزرسانی گردید');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Images  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Images $image)
    {
        if (file_exists($image->photo))
            unlink($image->photo);
        $image->delete();

        return redirect()->back()->with('success' , 'تصویر با موفقیت حذف گردید');
    }
}
