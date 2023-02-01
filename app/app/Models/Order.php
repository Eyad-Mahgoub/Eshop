<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'userdetail_id',
        'status',
        'message',
        'total_price',
        'tracking_no',
    ];

    public function userdetail()
    {
        return $this->hasOne(UserDetails::class, 'id', 'userdetail_id');
    }

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }
}
