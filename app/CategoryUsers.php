<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryUsers extends Model
{
    protected $table='category_user';
    public $timestamps=false;
    protected $fillable = [
        'name'
    ];

    public static function getCat(){
        $array=[];
        $list=Self::get();
        foreach ($list as $key=>$value) {
            $array[$value->id]=$value->name;
        }
        return $array;
    }

}
