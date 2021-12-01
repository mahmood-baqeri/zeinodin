<?php

namespace App\Http\Controllers;

use App\Contact;
use App\InsertCourse;
use App\Menu;
use App\BoniadNews;
use App\Page;
use Auth;
use Illuminate\Http\Request;
use Image;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;


class BoniadNewsController extends Controller
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
        $all = BoniadNews::latest()->get();
        return view('admin.boniadNews.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.boniadNews.new');
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
                $file_name = time() . rand(10, 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo'] = $destinationPath . $file_name;
            }

            $request['user_id'] = Auth()->user()->id;
            $count = BoniadNews::where('name', $request->name)->count();
            if ($count > 1) {
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name) . '-' . $count;
            } else
                $request['slug'] = str_replace(' ', '-', $request->name);

            if($request->important == 1)
                BoniadNews::where('important' , 1)->update(['important'=> 0]);

            BoniadNews::create($request->all());
            return redirect()->back()->with('success', 'خبر  جدید با موفقیت ایجاد گردید');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\BoniadNews $boniadNews
     * @return \Illuminate\Http\Response
     */
    public function edit(BoniadNews $boniadNews)
    {
        return view('admin.boniadNews.edit', compact('boniadNews'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BoniadNews $boniadNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoniadNews $boniadNews)
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
                if (file_exists($boniadNews->photo)) {
                    unlink($boniadNews->photo);
                }
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10, 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo'] = $destinationPath . $file_name;
            }

            $request['user_id'] = Auth()->user()->id;
            $count = BoniadNews::where('name', $request->name)->count();
            if ($count > 1) {
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name) . '-' . $count;
            } else
                $request['slug'] = str_replace(' ', '-', $request->name);

            if($request->important == 1)
                BoniadNews::where('important' , 1)->update(['important'=> 0]);

            $boniadNews->update($request->all());
            return redirect()->back()->with('success', 'خبر  با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\BoniadNews $boniadNews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $boniadNews = BoniadNews::find($id);
        if (file_exists($boniadNews->photo))
            unlink($boniadNews->photo);

        $boniadNews->delete();
        return redirect()->back()->with('success', 'خبر با موفقیت حذف گردید');
    }


    ##################################### Front
    public function all()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $boniadNews = BoniadNews::where('status', 1)->latest()->get();
        return view('boniad_news_all', ['contact_data' => $contact_data, 'menu' => $menu, 'boniadNews' => $boniadNews]);
    }


    public function detail($slug)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $boniadNews = BoniadNews::where('slug', $slug)->first();
        return view('boniad_news_detail', ['contact_data' => $contact_data, 'menu' => $menu, 'boniadNews' => $boniadNews]);
    }

########################### End Front


}
