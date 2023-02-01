<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    protected $table = 'user_details';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone_no',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'userdetail_id', 'id');
    }
}
