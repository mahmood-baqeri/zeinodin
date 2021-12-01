<?php

namespace App;

use App\Casts\Serialize;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table="media";
    protected $fillable=[
        'type',
        //    1        عکس ها
        //    2         فیلم ها
        //    3      سخنرانی ها
        //    4       وبینار ها

        'file',
        'category_id',
        'title',
    ];

    public function category()
    {
        return $this->belongsTo(MediaCategory::class ,'category_id' ,'id');
    }
}
