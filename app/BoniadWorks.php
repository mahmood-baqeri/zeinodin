<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BoniadWorks extends Model
{
    protected $table ="boniad_works";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'metaKeywords',
        'metaDescription',
    ];

}
