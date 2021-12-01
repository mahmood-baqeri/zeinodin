<?php

 function UrlAdmin($Url, $Controller, $main, $role){
     if($main ==""){
         Route::get("/$Url/index" , "$Controller@index_$Url");
         Route::get("/$Url/insert" , "$Controller@insert_$Url");
         Route::get("/$Url/edit/{id}" , "$Controller@edit_$Url");
     }else{
         Route::get("/$main/$Url/index" , "$Controller@index_$Url");
         Route::get("/$main/$Url/insert" , "$Controller@insert_$Url");
         Route::get("/$main/$Url/edit/{id}" , "$Controller@edit_$Url");
     }
     if ($role = 'role'){
         Route::get("/$Url/index/{role}" , "$Controller@index_$Url");
         Route::get("/$Url/insert/{role}" , "$Controller@insert_$Url");
         Route::get("/$Url/edit/{id}/{role}" , "$Controller@edit_$Url");
     }


}


function ApiUrlAdmin($Url, $Controller){
    Route::post("admin/insert_$Url" , "$Controller@insert_$Url");
    Route::post("admin/edit_$Url" , "$Controller@edit_$Url");
    Route::post("admin/delete_$Url" , "$Controller@delete_$Url");
 }

function get_url($string){
    $url=str_replace('-',' ',$string);
    $url=str_replace('/',' ',$url);
    $url=preg_replace('/\s+/','-',$url);
    return $url;
}

function upload_file($request,$directory, $name_file){
    if ($request->hasFile($name_file)) {
        $FileName = time() . '.' . $request->file($name_file)->getClientOriginalExtension();
        $request->file($name_file)->move('image/'.$directory, $FileName);
    }else {
        $FileName = 'image.png';
    }
    return $FileName;
}

function uploadPhoto($photo, $last = null)
{
    if (file_exists($last))
        unlink($last);

    $extention = $photo->getClientOriginalExtension();
    $name = time() . random_int(1000, 9999);
    $url = "image/$name.$extention";
    $img = \Image::make($photo);
    $img->save($url);
    return $url;
}




function edit_upload_file($request,$name,$directory, $name_file){
    if ($request->hasFile($name_file)) {
        $path=public_path().'/image/'.$directory.'/'.$name;
        if (file_exists($path) && $name != 'image.png'){
            unlink($path);
        }
        $FileName = time() . '.' . $request->file($name_file)->getClientOriginalExtension();
        $request->file($name_file)->move('image/'.$directory, $FileName);
        return $FileName;
    }else{
        return $name;
    }

}
function remove_file($name,$directory){
    $path=public_path().'/image/'.$directory.'/'.$name;
    if (file_exists($path) && $name != 'image.png'){
        unlink($path);
    }else{
        return null;
    }
}
function limitWord($string, $limit){
    $words = explode(" ",$string);
    $output = implode(" ",array_splice($words,0,$limit));
    return $output;
}
