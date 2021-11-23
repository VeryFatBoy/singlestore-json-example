<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Cast attributes JSON to array
    protected $casts = [
        'attributes' => 'array'
    ];

    // Each product has a brand
    public function brand()
    {
        return $this->belongsTo('Brand');
    }

    // Each product has a category
    public function category()
    {
        return $this->belongsTo('Category');
    }

    protected $fillable = ['name', 'brand_id', 'category_id', 'attributes'];
}
