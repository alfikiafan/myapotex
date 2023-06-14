<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'medicine_id',
        'quantity',
        'price',
        'discount',
        'subtotal',
    ];
}
