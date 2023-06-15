<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $all)
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $primaryKey = 'id';
    public $incrementing = false;

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->id) {
                $user->id = 'U' . str_pad(static::maxIdNumber() + 1, 4, '0', STR_PAD_LEFT);
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

    public function getJoiningDateAttribute($value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'joining_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // eloquent relationship with sale
    public function sales()
    {
        return $this->hasMany(Sale::class, 'cashier_id', 'id');
    }
}
