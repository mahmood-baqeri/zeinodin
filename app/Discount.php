<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table='discount';
    public $timestamps=false;
    protected $fillable = [
        'code', 'discount', 'start_date', 'end_date' , 'count' ,'use_count' , 'course_id'
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
