<?php

namespace App\Http\Controllers;

use App\Biography;
use App\Blog;
use App\Contact;
use App\Menu;
use Illuminate\Http\Request;

class BiographyController extends Controller
{

    public function messages()
    {
        return [
            'description.required' => 'عنوان را وارد کنید.',
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
        $all = Biography::latest()->get();
        return view('admin.biography.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        return view('admin.biography.new', compact('type'));
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
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            if( $request->type == 1 )
                $request['slug'] ='شرح-زندگی';
            elseif( $request->type == 2 )
                $request['slug'] ="دوران-کاری";
            elseif( $request->type == 3 )
                $request['slug'] ="خدمات-ماندگار";
            elseif( $request->type == 4 )
                $request['slug'] ="افتخارات";
            elseif( $request->type == 5 )
                $request['slug'] ="کنفرانس-ها";
            else
                $request['slug'] ="عضویت-ها";


            Biography::create($request->all());
            return redirect()->back()->with('success', 'زندگی نامه با موفقیت ایجاد گردید');
        }

    }

    public function biographyShow($slug)
    {
        $contact_data = Contact::where('id' , '1')->first();
        $menu = Menu::where(['parent_id' => '0' , ['name' , '!=' , 'خدمات']])->get();
        $biography = Biography::where('slug' , $slug)->first();
        return view('biography' , ['contact_data'=>$contact_data , 'menu'=>$menu ,  'biography'=>$biography ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Biography $biography
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $biography =Biography::find($id);
        return view('admin.biography.edit', compact('biography'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Biography $biography
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $biography = Biography::find($id);

        $validator = \Validator::make($request->all(), [
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',

        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            if( $request->type == 1 )
                $request['slug'] ='شرح-زندگی';
            elseif( $request->type == 2 )
                $request['slug'] ="دوران-کاری";
            elseif( $request->type == 3 )
                $request['slug'] ="خدمات-ماندگار";
            elseif( $request->type == 4 )
                $request['slug'] ="افتخارات";
            elseif( $request->type == 5 )
                $request['slug'] ="کنفرانس-ها";
            else
                $request['slug'] ="عضویت-ها";

            $biography->update($request->all());
            return redirect()->back()->with('success', 'زندگی نامه با موفقیت بروزرسانی گردید');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Biography $biography
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Biography::destroy($id);
        return redirect()->back()->with('success', 'زندگی نامه با موفقیت حذف گردید');
    }
}
