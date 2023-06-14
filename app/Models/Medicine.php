<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $validatedData)
 */
class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($medicine) {
            $medicine->id = 'M' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
        });
    }

    protected static function maxIdNumber(): int
    {
        $maxId = static::max('id');
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
}
