<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsertCourse extends Model
{
    protected $table="insert_course";
    public $timestamps=false;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'mobile',
        'phone',
        'nationalCode',
        'course_id',
        'slider_id',
        'type',
        'authority',
        'price',
        'discount',
        'discount_price',
        'status',

        'spotPlayerId',
        'spotPlayerKey',
        'spotPlayerUrl',
    ];

    public function getCourse(){
        return $this->hasOne(Course::class,'id','course_id')->withDefault(['title'=>'']);
    }
    public function getSlider(){
        return $this->hasOne(Slider::class,'id','slider_id')->withDefault(['title'=>'']);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
