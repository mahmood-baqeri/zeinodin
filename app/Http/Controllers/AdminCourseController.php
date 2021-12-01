<?php

namespace App\Http\Controllers;

use App\Course;
use App\InsertCourse;
use App\Discount;
Use Verta;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    public function messages(){
        return [
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

    public function insert_course(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' => 'integer',
            'title' => 'required',
            'text' => 'required_if:status,1',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $course = new Course($request->all());
            $v = new Verta();
            $course->date = $v->formatJalaliDate();
            $course->url = get_url($course->title);

            if ($course->save()){
                $file_upload = upload_file($request, "course", 'file');
                $course->img = $file_upload;
                $course->save();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function edit_course(Request $request){
        $validator = \Validator::make($request->all(), [
            'user_id' => 'integer',
            'title' => 'required',
            'text' => 'required_if:status,1',
        ], $this->messages());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $id = $request->id;
            $course = Course::where('id' , $id)->first();
            $course->url = get_url($course->title);
            if($course->update($request->all())){
                $file_upload = edit_upload_file($request, $course->img, 'course', 'file');
                $course->img = $file_upload;
                $course->update();

            }
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }

    public function delete_course(Request $request){
        $id = $request->id;
        $course = Course::where('id' , $id)->first();
        remove_file($course->img, 'course');
        $course = InsertCourse::where('course_id' , $id)->delete();
        $course = Course::where('id' , $id)->delete();
        return response()->json($course);
    }
    public function delete_course_user(Request $request){
        $id = $request->id;
        $course = InsertCourse::where('id' , $id)->delete();
        return response()->json($course);
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
            $discount = new Discount($request->all());
            $discount->save();
            return response()->json(['success' => 'با موفقیت ذخیره شد.']);
        }
    }
    public function delete_discount(Request $request){
        $id = $request->id;
        $discount= Discount::where('id' , $id)->delete();
        return response()->json($discount);
    }
}
