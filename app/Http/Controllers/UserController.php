<?php

namespace App\Http\Controllers;

use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

use App\Contact;
use App\ContactForm;
use App\Course;
use App\Discount;
use App\InsertCourse;
use App\lib\zarinpal;
use App\Menu;
use Illuminate\Http\Request;
use Verta;

class UserController extends Controller
{
    public function messages()
    {
        return [
            'name.required' => 'نام خود را وارد کنید.',
            'email.required' => 'ایمیل را وارد کنید.',
            'text.required' => 'پیام مورد نظر خود را وارد کنید.',
        ];
    }

    function insert_contact(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'text' => 'required',
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $contact_form = new ContactForm($request->all());
            $v = new Verta();
            $contact_form->date = $v->formatJalaliDatetime();
            $contact_form->save();
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    function insert_course(Request $request)
    {
        if ($request->name== "" && $request->email == "" && $request->mobile == "") {
            return redirect()->back()->with('error' , 'وارد کردن تمام اطلاعات الزامی است');
        } else {
            $course = InsertCourse::where(['status' => '1', 'mobile' => $request->mobile, 'course_id' => $request->course_id])->first();
            if ($course) {
                return redirect()->back()->with('IsUser' , 'شما قبلا در این دوره ثبت نام کرده اید.');
            } else {
                $not_course = InsertCourse::where(['status' => '0', 'mobile' => $request->mobile, 'course_id' => $request->course_id])->first();
                if ($not_course) {
                    $del_course = InsertCourse::where('id', $not_course->id)->delete();
                }

                $course = new InsertCourse($request->all());
                $v = new Verta();
                $course->date = $v->formatJalaliDatetime();
                $course->save();

                $course_price = Course::where('id', $course->course_id)->first();
                $price = str_replace(',', '', $course_price->price);

                if($price == 0){
                    $course->update(['status' => 1]);
                    $course_price->capacity = $course_price->capacity - 1;
                    $course_price->update();
                    return redirect()->route('guidePage')->with('paySuccess' , 'ثبت نام شما با موفقیت انجام شد.');
                }

                $course->price = $price;
                $resultPrice = $price;

                if($request->code) {
                    $code = Discount::whereRaw("BINARY `code`= ?", $request->code)->first();
                    if ($code) {
                        $v2 = new Verta();
                        $today = str_replace('-', '/', $v2->formatDate());
                        if ($code->course_id == $request->course_id) {
                            if (($today >= $code->start_date || $today <= $code->end_date) && ($code->count > $code->use_count)) {
                                $code->use_count += 1;
                                $code->save();
                                $resultPrice = ($price - (($code->discount / 100) * $price));
                                $course->discount = $price - $resultPrice ;
                                $course->discount_price = $resultPrice ;
                            }
                        }
                    }
                } else {
                    $course->discount_price = 0;
                }

                $course->update();


                return Payment::callbackUrl('https://zeinodin.org/payment/callback')->purchase(
                    (new Invoice)->amount((int) $resultPrice )
                        ->detail(['mobile' => $request->mobile ,'course_id' => $request->course_id , 'email' => $request->email ]),
                    function($driver, $transactionId) use($course) {
                        $course->authority = $transactionId;
                        $course->update();
                    }
                )->pay()->render();

            }
        }
    }

    public function payCallback(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();

        $insertCourse = InsertCourse::where('authority' , $request['Authority'])->first();

        if($request['Status'] == 'NOK')
            return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu ,'returnMsg' => 'لغو خرید توسط شما']);

        if(!$insertCourse)
            return redirect()->route('indexPage');

        if($insertCourse->status == 0) {
            $returnMsg = "";
            try {
                $receipt = Payment::amount((int)$insertCourse->discount_price)->transactionId($insertCourse->authority)->verify();

                $insertCourse->update(['status' => 1]);
                $course = Course::where('id', $insertCourse->course_id)->first();
                $course->capacity = $course->capacity - 1;
                $course->update();

                return redirect()->route('guidePage')->with('paySuccess' , 'ثبت نام شما با موفقیت انجام شد.');

            } catch (InvalidPaymentException $exception) {
                $returnMsg = $exception->getMessage();
            }
        }
        else
            $returnMsg = "قبلا تعیین وضعیت شده است";



        return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu ,'returnMsg' => $returnMsg]);
    }


    public function order(Request $request)
    {
        $contact_data = Contact::where('id', '1')->first();
        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();


        $MerchantID = '935653b4-9beb-4295-90e1-a2d458efbad2';
        $Authority = $request->get('Authority');
        $auth = InsertCourse::where('authority', $Authority)->first();
        $Amount = $auth->price;
        if ($request->get('Status') == 'OK') {
            $client = new \nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
            $client->soap_defencoding = 'UTF-8';
            $result = $client->call('PaymentVerification', [
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ],
            ]);

            echo $result['Status'];

            if ($result['Status'] == 100) {
                $auth->status = '1';
                $auth->update();
                $course = Course::where('id', $auth->course_id)->first();
                $course->capacity = $course->capacity - 1;
                $course->update();
                //  mahmood

                return view('order', ['status' => '1', 'contact_data' => $contact_data, 'menu' => $menu, 'course' => $course, 'auth' => $auth]);
            } else {
                return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu]);
            }
        } else {
            return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu]);
        }
    }


//    function insert_course(Request $request)
//    {
//        $validator = \Validator::make($request->all(), [
//            'name' => 'required',
//            'mobile' => 'required',
//            'email' => 'required',
//        ], $this->messages());
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()->all()]);
//        } else {
//            $course = InsertCourse::where(['status' => '1', 'mobile' => $request->mobile, 'course_id' => $request->course_id])->first();
//            if ($course) {
//                return response()->json(['IsUser' => 'شما قبلا در این دوره ثبت نام کرده اید.']);
//            } else {
//                $not_course = InsertCourse::where(['status' => '0', 'mobile' => $request->mobile, 'course_id' => $request->course_id])->first();
//                if ($not_course) {
//                    $del_course = InsertCourse::where('id', $not_course->id)->delete();
//                }
//
//                $code = Discount::where('code', $request->code)->first();
//                if ($code) {
//                    $code->use_count += 1;
//                    $code->save();
//                }
//
//                $course = new InsertCourse($request->all());
//                $v = new Verta();
//                $course->date = $v->formatJalaliDatetime();
//                $course->save();
//
//                $course_price = Course::where('id', $course->course_id)->first();
//                $price = str_replace(',', '', $course_price->price);
//                $course->price = $price;
//                $course->discount_price = $price - (($course->discount / 100) * $price);
//
//                $order = new zarinpal();
//                $res = $order->pay($course->discount_price, $course->email, $course->mobile);
//                $course->authority = $res;
//                $course->update();
//                return response()->json(['zarinpal' => $res]);
//            }
//        }
//    }

//    public function order(Request $request)
//    {
//        $contact_data = Contact::where('id', '1')->first();
//        $menu = Menu::where(['parent_id' => '0', ['name', '!=', 'خدمات']])->get();
//        $MerchantID = '935653b4-9beb-4295-90e1-a2d458efbad2';
//        $Authority = $request->get('Authority');
//        $auth = InsertCourse::where('authority', $Authority)->first();
//        $Amount = $auth->price;
//        if ($request->get('Status') == 'OK') {
//            $client = new \nusoap_client('https://www.zarinpal.com/pg/services/WebGate/wsdl', 'wsdl');
//            $client->soap_defencoding = 'UTF-8';
//            $result = $client->call('PaymentVerification', [
//                [
//                    'MerchantID' => $MerchantID,
//                    'Authority' => $Authority,
//                    'Amount' => $Amount,
//                ],
//            ]);
//
//            echo $result['Status'];
//
//            if ($result['Status'] == 100) {
//                $auth->status = '1';
//                $auth->update();
//                $course = Course::where('id', $auth->course_id)->first();
//                $course->capacity = $course->capacity - 1;
//                $course->update();
//                //  mahmood
//
//                return view('guide', ['status' => '1', 'contact_data' => $contact_data, 'menu' => $menu, 'course' => $course, 'auth' => $auth]);
//                return view('order', ['status' => '1', 'contact_data' => $contact_data, 'menu' => $menu, 'course' => $course, 'auth' => $auth]);
//            } else {
//                return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu]);
//            }
//        } else {
//            return view('order', ['status' => '0', 'contact_data' => $contact_data, 'menu' => $menu]);
//        }
//    }

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
//            $code = Discount::where('code', $request->code)->first();
            $code = Discount::whereRaw("BINARY `code`= ?",  $request->code)->first();
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
            if(Discount::where("code",  $request->code)->first())
                return response()->json(['status' => -1]);
            return response()->json(['status' => 1]);
        }
    }

}
