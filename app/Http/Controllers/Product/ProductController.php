<?php

namespace App\Http\Controllers\Product;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Mail\payProducteMail;
use App\Menu;
use App\Product;
use App\ProductCategory;
use App\ProductDiscount;
use App\ProductSale;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Image;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;


class ProductController extends Controller
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

            'text.required' => 'متن را وارد کنید.',
            'file.max'      => ' حداکثر حجم فایل 10 مگ است.',
            'file.mimes'      => 'فرمت عکس نامعتبر می باشد. (jpeg,jpg,png)',
            'title.required' => 'عنوان را وارد کنید.',
            'text.required_if' =>'در صورت انتخاب وضعیت فعال، متن را وارد کنید.',
            'user_id.integer' =>'مدرس مورد نظر را انتخاب کنید.',
            'code.required' =>  'کد تخفیف را وارد کنید.',
            'start_date.required' => 'زمان شروع را وارد کنید.',
            'end_date.required' => 'زمان انقضا را وارد کنید.',
            'count.required' => ' تعداد را وارد کنید.',
            'discount.required' => 'درصد تخفیف را وارد کنید.',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Product::latest()->get();
        return view('admin.product.all', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::select('id', 'name')->get();
        return view('admin.product.new', compact('categories'));
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
            $count = Product::where('name', $request->name)->count();
            if ($count > 1) {
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name) . '-' . $count;
            } else
                $request['slug'] = str_replace(' ', '-', $request->name);

            Product::create($request->all());
            return redirect()->back()->with('success', 'محصول  جدید با موفقیت ایجاد گردید');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::select('id', 'name')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
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
                if (file_exists($product->photo)) {
                    unlink($product->photo);
                }
                $file = $request->file('file');
                $destinationPath = 'public/image/img/';
                $file_name = time() . rand(10, 99) . "." . $file->getClientOriginalExtension();
                $file->move($destinationPath, $file_name);
                $request['photo'] = $destinationPath . $file_name;
            }

            $request['user_id'] = Auth()->user()->id;
            $count = Product::where('name', $request->name)->count();
            if ($count > 1) {
                $count++;
                $request['slug'] = str_replace(' ', '-', $request->name) . '-' . $count;
            } else
                $request['slug'] = str_replace(' ', '-', $request->name);
            $product->update($request->all());
            return redirect()->back()->with('success', 'محصول  با موفقیت بروزرسانی گردید');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (file_exists($product->photo))
            unlink($product->photo);

        $product->delete();
        return redirect()->back()->with('success', 'محصول با موفقیت حذف گردید');
    }


    ##################################### Front
    public function all()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $products = Product::where('status', '1')->latest()->get();

        $data['min'] = '';
        $data['max'] = '';
        $data['sort'] = '';
        $data['text'] = '';
        return view('product', ['contact_data' => $contact_data, 'menu' => $menu, 'products' => $products, 'data' => $data]);
    }

    public function category($slug)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $category = ProductCategory::where('slug', $slug)->first();
        $products = Product::where('status', '1')->where('category_id', $category->id)->orderby('id', 'desc')->get();

        $data['min'] = '';
        $data['max'] = '';
        $data['sort'] = '';
        $data['text'] = '';
        return view('product', ['contact_data' => $contact_data, 'menu' => $menu, 'products' => $products, 'data' => $data]);
    }

    public function search(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();


        $products = Product::query();
        if ($request->text)
            $products = $products->where('name', 'LIKE', '%' . $request->text . '%');

        if ($request->min)
            $products = $products->where('price', '>=', $request->min);

        if ($request->max)
            $products = $products->where('price', '<=', $request->max);

        switch ($request->sort) {
            case 'newest':
                $products = $products->orderBy('id', 'desc');
                break;
            case 'oldest':
                $products = $products->orderBy('id', 'asc');
                break;
            case 'sale':
//                $products = $products->whereHas('has' , function (){
//
//                })->get();
                $products = $products->withCount('sale');
                break;
            case 'view':
                $products = $products->orderBy('seeCount', 'desc');
                break;
        }

        $products = $products->get();

        $data['min'] = $request->min;
        $data['max'] = $request->max;
        $data['sort'] = $request->sort;
        $data['text'] = $request->text;
        return view('product', ['contact_data' => $contact_data, 'menu' => $menu, 'products' => $products, 'data' => $data]);
    }

    public function detail($slug)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
        $product = Product::where('slug', $slug)->first();
        $product->increment('seeCount');
        return view('productDetail', ['contact_data' => $contact_data, 'menu' => $menu, 'product' => $product]);
    }

    public function pay(Request $request)
    {
        if ($request->name == "" && $request->email == "" && $request->mobile == "") {
            return redirect()->back()->with('error', 'وارد کردن تمام اطلاعات الزامی است');
        } else {
            $product = Product::find($request->product_id);
            if (!$product)
                return redirect()->back()->with('error', 'مشکل ناشناخته ، دوباره تلاش کنید');

            $sale = ProductSale::create([
                'product_id' => $request->product_id,
                'seller_name' => $request->name,
                'seller_mobile' => $request->mobile,
                'seller_email' => $request->email,
                'transactionId' => null,
                'price' => 0,
                'status' => 0
            ]);

            $finalPrice = 0;
            $code = ProductDiscount::where("code",  $request->code)->first();
            if ($code) {
                $v2 = new Verta();
                $today = str_replace('-', '/', $v2->formatDate());
                if ($code->course_id == $request->course_id) {
                    if ( ($today >= $code->start_date || $today <= $code->end_date) && ($code->count > $code->use_count) ) {
                        $code->use_count += 1;
                        $code->save();
                       $finalPrice = ($product->price - (($code->discount / 100) * $product->price));
                    }
                }
            }
            else
                 $finalPrice = $product->price;

            $sale->update(['price' => $finalPrice]);

            return Payment::callbackUrl('https://zeinodin.org/product/pay/callback')->purchase(
                (new Invoice)->amount((int)$finalPrice)
                    ->detail(['mobile' => $request->mobile, 'course_id' => $request->course_id, 'email' => $request->email]),
                function ($driver, $transactionId) use ($sale) {
                    $sale->update(['transactionId' => $transactionId]);
                    session()->put('transactionIdProduct', $transactionId);
                }
            )->pay()->render();

        }
    }

    public function payCallback()
    {
        $sale = ProductSale::where('transactionId', session()->get('transactionIdProduct'))->first();
        session()->forget('transactionIdProduct');

        if (!$sale) return redirect()->route('indexPage');

        $returnMsg = "";
        try {
            $receipt = Payment::amount((int)$sale->price)->transactionId($sale->transactionId)->verify();
            $sale->update(['status', 1]);

            // Mail::to($sale->seller_email)->send(new SampleEmail($sale->product_id));
            $product = Product::find($sale->product_id);
            session()->put('downloadLink' , $product->link);

            $contact_data = Contact::where('id', '1')->first();
            $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

            return view('productLink', ['contact_data' => $contact_data, 'menu' => $menu, 'product' => $product])->with('paySuccess');

        } catch (InvalidPaymentException $exception) {
            $returnMsg = $exception->getMessage();
        }

        return redirect()->route('product.all')->with('payError');
    }

    public function discount()
    {
        $discount = ProductDiscount::orderby('id', 'desc')->get();
        return view('admin/product/discount', ['discount' => $discount]);
    }
    public function insert_discount(Request $request){
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
            'count' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $discount = new ProductDiscount($request->all());
            $discount->save();
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }
    public function delete_discount(Request $request){
        $id = $request->id;
        $discount= ProductDiscount::where('id' , $id)->delete();
        return response()->json($discount);
    }

    public function check_code(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $v = new Verta();
            $today = str_replace('-', '/', $v->formatDate());
            $code = ProductDiscount::where("code",  $request->code)->first();
            if ($code) {
                if ($code->course_id == $request->course_id) {
                    if ( ($today >= $code->start_date || $today <= $code->end_date) && ($code->count > $code->use_count) )
                        $discount = $code->discount;
                    else
                        $discount = 'exp';
                } else
                    $discount = 'courseNot';
            } else {
                $discount = 'not';
            }
            return response()->json(['success' => $discount]);
        }
    }

    public function checkDuplicateCode(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            if(ProductDiscount::where("code",  $request->code)->first())
                return response()->json(['status' => -1]);
            return response()->json(['status' => 1]);
        }
    }


    public function sale()
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $sale = ProductSale::all();
        return view('admin.product.sale', ['contact_data' => $contact_data, 'menu' => $menu, 'sale' => $sale]);
    }

########################### End Front


}
