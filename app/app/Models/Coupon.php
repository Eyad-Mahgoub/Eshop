<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'name',
        'value',
        'max_amount',
        'type',
        'start_date',
        'end_date',
    ];

    public function products()
    {
        return $this->hasMany(DiscountedProduct::class, 'coupon_id', 'id');
    }
}
