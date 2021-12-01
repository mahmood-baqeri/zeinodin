<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Media;
use App\MediaCategory;
use App\Menu;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return redirect()->back();
    }

    public function show($type)
    {
        $media = Media::where('type', $type)->get();
        $category = MediaCategory::latest()->get();
        return view('admin.media.all', compact('media', 'type', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $destinationPath = 'media/';
            $file_name = time() . rand(10, 99) . "." . $images->getClientOriginalExtension();
            $images->move($destinationPath, $file_name);
            $file = $destinationPath . $file_name;

            Media::create([
                'type' => $request->type,
                'title' => $request->title,
                'category_id' => $request->category_id,
                'file' => $file,
            ]);

            return redirect()->back()->with('success', 'محتوا جدید با موفقیت ایجاد گردید');
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        if(!Media::find($id))
            return redirect()->back();
        $media = Media::find($id);
        $category = MediaCategory::latest()->get();
        return view('admin.media.edit', compact('media', 'category'));
    }

    public function update(Request $request , $id)
    {
        $media = Media::find($id);
        $file = $media->file;
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $destinationPath = 'media/';
            $file_name = time() . rand(10, 99) . "." . $images->getClientOriginalExtension();
            $images->move($destinationPath, $file_name);
            $file = $destinationPath . $file_name;
        }

        $media->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file' => $file,
        ]);

        return redirect()->back()->with('success', 'محتوا با موفقیت بروزرسانی گردید');
    }


    public function destroy($id)
    {
        $media = Media::find($id);
        if (file_exists("$media->file"))
            unlink("$media->file");
        $media->delete();

        return redirect()->back()->with('success', 'محتوا  با موفقیت حذف گردید');
    }

    public function mediaAlbum($title)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        if ($title == 'عکس') $type = 1;
        if ($title == 'فیلم') $type = 2;
        if ($title == 'سخنرانی') $type = 3;
        if ($title == 'وبینار') $type = 4;
        if ($title == 'فروشگاه') $type = 5;

        $category = MediaCategory::with(['media' => function($query) use ($type) {
            $query->where('type' , $type);
        }])->get();

        return view('mediaAlbum', ['contact_data' => $contact_data, 'menu' => $menu, 'category' => $category , 'type' => $type ]);
    }

    public function mediaShow($id , $type)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $media = Media::where('category_id', $id)->where('type' , $type)->get();
        $category = MediaCategory::find($id);
        return view('media', ['contact_data' => $contact_data, 'menu' => $menu, 'media' => $media , 'category' => $category]);
    }
}
