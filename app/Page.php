<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
class Page extends Model
{
//    use SoftDeletes;
    protected $table="page";
//    public $timestamps=false;
    protected $fillable = [
        'text', 'menu_id', 'status', 'img', 'title', 'text_short', 'text_short', 'user_id', 'url', 'url_default' , 'url_file',
    ];
    public function getCat(){
        return $this->hasOne(Menu::class,'id','menu_id')->withDefault(['name'=>'']);
    }
    public static  function getStatus(){
        $array=array();
        $array[0]='غیر فعال';
        $array[1]='فعال';
        return $array;
    }
    public function getUser(){
        return $this->hasOne(User::class,'id','user_id')->withDefault(['name'=>'']);
    }
}
