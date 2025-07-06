<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
        protected $fillable = [
        'product_id',
        'customer_id',
        'quantity',
        'unit_price',
        'total',
        'payment',
        'quota_qtd',
        'payment_date',
        'quota_details',
    ];

        public function product()
    {
        return $this->belongsTo(Product::class);
    }

        public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
