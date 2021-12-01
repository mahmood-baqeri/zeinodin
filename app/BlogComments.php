<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComments extends Model
{
    protected $table ="blog_comments";
    protected $fillable = [
        'cookie_key',
        'blog_id',
        'user_name',
        'user_mail',
        'comment',
        'parent_id',
        'status',
        'user_is_admin',
    ];

    public function child()
    {
        return $this->hasMany(BlogComments::class,'parent_id' ,'id')
            ->where('status' , 1);
    }
}

