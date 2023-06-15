<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    // laravel think the table is detail_sales by default
    protected $table = 'detailsales';

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($detailSale) {
            if (!$detailSale->id) {
                $detailSale->id = 'DS' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected static function maxIdNumber()
    {
        $maxId = static::max('id');
        if ($maxId) {
            return intval(substr($maxId, 2));
        }
        return 0;
    }

    protected $fillable = [
        'sale_id',
        'medicine_id',
        'quantity',
        'price',
        'discount',
        'subtotal',
    ];

    // eloquent relationship with sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    // eloquent relationship with medicine
    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id', 'id');
    }
}
