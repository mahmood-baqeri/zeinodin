<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
//    use SoftDeletes;
    protected $table="contact_form";
    public $timestamps=false;
    protected $fillable = [
        'email', 'text', 'subject', 'name', 'date','mobile', 'new'
    ];
}
