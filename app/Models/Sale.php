<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($sale) {
            if(!$sale->id) {
                $sale->id = 'S' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected static function maxIdNumber()
    {
        $maxId = static::max('id');
        if ($maxId) {
            return intval(substr($maxId, 1));
        }
        return 0;
    }

    protected $fillable = [
        'cashier_id',
        'discount',
        'total',
        'cash',
        'change',
    ];

    // eloquent relationship with user
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    // eloquent relationship with sale_detail
    public function detailSales()
    {
        return $this->hasMany(DetailSale::class, 'sale_id', 'id');
    }
}
