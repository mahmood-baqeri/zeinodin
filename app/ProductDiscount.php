<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    protected $table='discount_product';
    public $timestamps=false;
    protected $fillable = [
        'code', 'discount', 'start_date', 'end_date' , 'count' ,'use_count' , 'product_id'
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
