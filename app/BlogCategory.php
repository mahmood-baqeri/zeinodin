<?php

namespace App;

use App\Casts\Serialize;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table ="blog_category";
    protected $fillable = [
        'name',
        'slug',
        'status',
        'parent_id',
        'metaTitle',
        'metaKeywords',
        'metaDescription',
    ];

    public function child()
    {
       return $this->hasMany(BlogCategory::class ,'parent_id' ,'id');
    }

    public function parent()
    {
       return BlogCategory::find($this->parent_id);
    }

    public function postCount()
    {
       return Blog::where('category_id' , $this->id)->where('status' , 1)->count();
    }
}
