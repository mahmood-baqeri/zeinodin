<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
//    use SoftDeletes;
    protected $table="site";
    public $timestamps=false;
    protected $fillable = [
        'title', 'link', 'row_co', 'status', 'img',
    ];
}
