<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAbout extends Model
{
    protected $table="about_user";
    public $timestamps=false;
    protected $fillable = [
        'img',
        'status', //m     هئیت امنا 0      1 تیم اجرایی      2 مدیر اجرایی
        'name',
        'detail',
        'title'
    ];
}
