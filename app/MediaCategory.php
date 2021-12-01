<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaCategory extends Model
{
    protected $table="media_category";
    protected $fillable=[
        'name',
        'photo',
        'parent_id',
    ];

    public function child()
    {
        return $this->hasMany(MediaCategory::class ,'parent_id' ,'id');
    }

    public function media()
    {
        return $this->hasMany(Media::class ,'category_id' ,'id');
    }

    public function parent()
    {
        return MediaCategory::find($this->parent_id);
    }


}
