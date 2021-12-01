<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $table ="biography";
    protected $fillable = [
        'type',
        //   1      شرح زندگی
        //   2      دوران کاری
        //   3    خدمات ماندگار
        //   4        افتخارات
        //   5      کنفرانس ها
        //   6      عضویت ها

        'slug',
        'description',
        'metaTitle',
        'metaKeywords',
        'metaDescription',
    ];
}
