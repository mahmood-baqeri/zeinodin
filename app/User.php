<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'gender', 'birthday', 'name_co', 'phone', 'mobile', 'email',
        'website', 'password', 'text', 'address', 'category_id', 'role', 'status','type_user',
        'position',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function get_user(){
        $array=[0=>'انتخاب کنید'];
        $list=Self::where([['type_user' , '!=' , '1'],'role'=>'2' , 'status'=>'1' ])->orderby('position' , 'asc')->get();

        foreach ($list as $key=>$value) {
            $array[$value->id]=$value->name.' '.$value->last_name;
        }
        return $array;
    }
    public function getCategory(){
        return $this->hasOne(CategoryUsers::class,'id','category_id')->withDefault(['name'=>'']);
    }
    public static  function getType(){
        $array=array();
        $array[1]='مشاور';
        $array[2]='مدرس';
        $array[3]='مشاور و مدرس';
        return $array;
    }
    public static  function getStatus(){
        $array=array();
        $array[0]='غیر فعال';
        $array[1]='فعال';
        return $array;
    }
}
