<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $validatedData)
 */
class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($medicine) {
            if (!$medicine->id) {
                $medicine->id = 'M' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    protected static function maxIdNumber(): int
    {
        $maxId = static::withTrashed()->max('id');
        if ($maxId) {
            return intval(substr($maxId, 1));
        }
        return 0;
    }

    protected $fillable = [
        'name',
        'brand',
        'category',
        'quantity',
        'discount',
        'price',
    ];

    // eloquent relationship with detail_sale
    public function detailSales()
    {
        return $this->hasMany(DetailSale::class, 'medicine_id', 'id');
    }
}
