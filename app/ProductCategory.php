<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
class ProductCategory extends Model
{

    protected $table="product_category";
    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
        'metaTitle',
        'metaKeywords',
        'metaDescription'
    ];

    public function child()
    {
        return $this->hasMany(ProductCategory::class ,'parent_id' ,'id');
    }

    public function parent()
    {
        return ProductCategory::find($this->parent_id);
    }

    public function postCount()
    {
        return Product::where('category_id' , $this->id)->where('status' , 1)->count();
    }

}
