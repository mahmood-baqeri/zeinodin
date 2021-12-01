<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table="slider";
    public $timestamps=false;
    protected $fillable = [
        'img', 'status', 'link', 'title', 'text', 'url', 'show'
    ];
    public static  function getStatus(){
        $array=array();
        $array[0]='غیر فعال';
        $array[1]='فعال';
        return $array;
    }
    public static  function getShow(){
        $array=array();
        $array[0]='خیر';
        $array[1]='بلی';
        return $array;
    }
}
