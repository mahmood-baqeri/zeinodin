<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table ="blog";
    protected $fillable = [
        'name',
        'slug',
        'summer',
        'description',
        'category_id',
        'photo',
        'status',  // 1 show    0 dontShow
        'user_id',
        'metaTitle',
        'metaKeywords',
        'metaDescription',
    ];

    public function author()
    {
       return $this->belongsTo(User::class ,'user_id', 'id');
    }

    public function category()
    {
       return $this->belongsTo(BlogCategory::class , 'category_id' , 'id');
    }

    public function comments()
    {
       return $this->hasMany(BlogComments::class)->where('status' , 1)->where('parent_id' , 0);
    }
}
