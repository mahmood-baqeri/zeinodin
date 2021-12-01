<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table='about';
    public $timestamps=false;
    protected $fillable = [
        'text', 'img', 'summer',
        'type'
        //m   0  =>  درباره بنیاد          about
        //m   1  =>   چشم انداز          vision
        //m   2  =>   ماموریت           mission
        //m   3  =>   اعضا             team
        //m   4  =>  اساس نامه          statute

        //m   5  =>   راهنمای وبینار      guide


    ];
}
