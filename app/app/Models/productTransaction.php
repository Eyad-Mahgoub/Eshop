<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productTransaction extends Model
{
    use HasFactory;

    protected $table = 'quantity_transactions';

    protected $guarded = [];

}
