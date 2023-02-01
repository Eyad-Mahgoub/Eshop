<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $table = 'products';

    // protected $appends = ['quantity'];

    public $translatedAttributes = [
        'name',
        'slug',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    protected $fillable = [
        'category_id',
        'original_price',
        'selling_price',
        'image',
        'tax',
        'status',
        'trending',
    ];

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

    public function quantity_transaction()
    {
        return $this->hasMany(productTransaction::class);
    }

    public function getQuantityAttribute()
    {
        return optional(
            $this->quantity_transaction()->selectRaw('SUM(`quantity` * `direction`) as qty')->first()
        )->qty;

    }
}
