<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    protected $table = 'categories';

    public $translatedAttributes = [
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    protected $fillable = [
        'status',
        'popular',
        'image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
