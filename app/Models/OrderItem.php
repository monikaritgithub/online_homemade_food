<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'chef_id', 'food_id', 'payment_method', 'payment_status', 'price', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'food_id');
    }

    public function orderedBy()
    {
        return $this->belongsTo(User::class, 'order_by');
    }

    public function orderedTo()
    {
        return $this->belongsTo(User::class, 'order_to');
    }
}
