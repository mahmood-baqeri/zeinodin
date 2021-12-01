<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contact";
    public $timestamps=false;
    protected $fillable = [
        'name_site', 'logo', 'length', 'width', 'telegram',
        'facebook', 'instagram', 'whatsapp', 'linkedin', 'twitter',
        'youtube', 'aparat', 'fax',  'phone', 'mobile', 'email', 'address',
    ];
}
