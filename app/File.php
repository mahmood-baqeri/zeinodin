<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table="file";
    public $timestamps=false;
    protected $fillable = [
        'img',
    ];
}
