<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
//    use SoftDeletes;
    protected $table='customer';
    public $timestamps=false;
    protected $fillable = [
        'title', 'link', 'img',
    ];
}
