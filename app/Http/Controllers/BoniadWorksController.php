<?php

namespace App\Http\Controllers;

use App\About;
use App\BoniadWorks;
use App\Contact;
use App\Menu;
use Illuminate\Http\Request;

class BoniadWorksController extends Controller
{

    public function messages()
    {
        return [
            'name.required' => 'عنوان را وارد کنید.',
            'description.required' => 'متن کامل را وارد کنید.',
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
        $all = BoniadWorks::latest()->get();
        return view('admin.boniadWorks.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.boniadWorks.new');
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
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {

            $count = BoniadWorks::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);

            BoniadWorks::create($request->all());
            return redirect()->back()->with('success', 'فعالیت  جدید با موفقیت ایجاد گردید');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\BoniadWorks $boniadWorks
     * @return \Illuminate\Http\Response
     */
    public function show(BoniadWorks $boniadWorks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BoniadWorks $boniadWorks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $boniadWorks = BoniadWorks::find($id);
        return view('admin.boniadWorks.edit', compact('boniadWorks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BoniadWorks $boniadWorks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $boniadWorks = BoniadWorks::find($id);
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'metaKeywords' => 'required',
            'metaDescription' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->with(['error' => $validator->errors()->all()]);
        } else {
            $count = BoniadWorks::where('name',$request->name)->count();
            if( $count > 1 ){
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name). '-' . $count;
            }
            else
                $request['slug'] = str_replace(' ', '-', $request->name);
            $boniadWorks->update($request->all());
            return redirect()->back()->with('success', 'فعالیت با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BoniadWorks $boniadWorks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BoniadWorks::destroy($id);
        return redirect()->back()->with('success', 'فعالیت  با موفقیت حذف گردید');
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
    public function single($slug)
    {
        $boniadWorks = BoniadWorks::where('slug' , $slug)->first();
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        return view('work_detail', ['contact_data' => $contact_data, 'boniadWorks' => $boniadWorks, 'menu' => $menu]);
    }

}
