<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'cover_image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
