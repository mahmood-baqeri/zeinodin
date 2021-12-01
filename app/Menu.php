<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Menu extends Model
{
//    use SoftDeletes;
    protected $table='menu';
    protected $fillable=['name','parent_id', 'url', 'img'];

    public static function get_parent(){
        $array=[0=>'دسته اصلی'];
        $list=Self::with('getChild.getChild')->where('parent_id',0)->get();
        foreach ($list as $key=>$value) {
            $array[$value->id]=$value->name;
        }
        return $array;
    }

    public static function get_menu(){
        $array=[0=>'انتخاب کنید'];
        $list=Self::with('getChild.getChild')->where('parent_id',0)->get();
        foreach ($list as $key=>$value) {
            $array[$value->id]=$value->name;
            foreach ($value->getChild2 as $key2=>$value2) {
                $array[$value2->id]=' - '.$value2->name;
                foreach ($value2->getChild2 as $key3=>$value3) {
                    $array[$value3->id]=' - -'.$value3->name;
                    foreach ($value3->getChild2 as $key4=>$value4) {
                        $array[$value4->id]=' - - '.$value4->name;
                    }
                }
            }
        }
        return $array;
    }

    public function getChild(){
        return $this->hasMany(Menu::class,'parent_id','id');
    }
    public function getChild2()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }


}

