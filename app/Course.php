<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
//    use SoftDeletes;
    protected $table="course";
    public $timestamps=false;
    protected $fillable = [
        'title',
        'text_short',
        'text',
        'user_id',
        'price',
        'time',
        'capacity',
        'status',
        'img',
        'url',
        'date_insert',
    ];
    public function getUser(){
        return $this->hasOne(User::class,'id','user_id')->withDefault(['name'=>'']);
    }
    public function getCategory(){
        return $this->hasOne(CategoryUsers::class,'id','user_id')->withDefault(['name'=>'']);
    }
    public static  function getStatus(){
        $array=array();
        $array[0]='غیر فعال';
        $array[1]='فعال';
        return $array;
    }
}
