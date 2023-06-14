<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($medicine) {
            $medicine->id = 'M' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
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
        'name',
        'brand',
        'category',
        'quantity',
        'discount',
        'price',
    ];
}
