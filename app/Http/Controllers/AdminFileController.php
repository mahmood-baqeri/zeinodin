<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class AdminFileController extends Controller
{
    public function messages(){
        return [
            'file.required'      => ' فایل را انتخاب کنید.',
        ];
    }

    public function insert_file(Request $request){
            $file = new File($request->all());
            $file_upload = upload_file($request, "file", 'file');
            $file->img = $file_upload;
            $file->save();
            return response()->json(['success'=>'با موفقیت ذخیره شد.']);
    }

    public function delete_file(Request $request){
        $id = $request->id;
        $file = File::where('id' , $id)->first();
        remove_file($file->img, 'file');
        $file_del = File::where('id' , $id)->delete();
        return response()->json($file_del);
    }
}
