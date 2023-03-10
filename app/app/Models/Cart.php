<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'prod_id');
    }
}
