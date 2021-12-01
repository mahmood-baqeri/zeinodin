<?php

namespace App;

use App\Casts\Serialize;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
class BoniadNews extends Model
{
    protected $table="boniad_news";
    protected $fillable = [
        'name',
        'slug',
        'summer',
        'description',
        'photo',
        'status',
        'important',  //m   خبر تکی کناری
        'metaKeywords',
        'metaDescription'
    ];
}

