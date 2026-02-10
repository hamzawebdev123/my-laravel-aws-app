<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    // In columns ko fill karne ki ijazat deni hai
    protected $fillable = [
        'invoice_number',
        'client_name',
        'client_email',
        'item_description',
        'quantity',
        'price',
        'total_amount',
    ];
}
