<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'customer_id',
        'paid_by',
        'status',
        'payment_type',
        'amount'
        // Add other fillable fields as needed
    ];
}
