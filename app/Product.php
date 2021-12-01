<?php

namespace App;

use App\Casts\Serialize;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
class Product extends Model
{
    protected $table="product";
    protected $fillable = [
        'name',
        'seeCount',
        'link',
        'slug',
        'price',
        'summer',
        'category_id',
        'description',
        'photo',
        'gallery',
        'status',
        'metaKeywords',
        'metaDescription'
    ];

    public function author()
    {
        return $this->belongsTo(User::class ,'user_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class , 'category_id' , 'id');
    }

    public function sale()
    {
        return $this->hasMany(ProductSale::class);
    }
}

