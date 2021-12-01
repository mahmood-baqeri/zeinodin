<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
class ProductSale extends Model
{
    protected $table="product_sale";
    protected $fillable = [
        'product_id',
        'seller_name',
        'seller_mobile',
        'seller_email',
        'transactionId',
        'price',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
