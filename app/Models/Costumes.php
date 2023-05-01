<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'size',
        'category',
        'store_id',
        'image_url'
    ];

    protected $casts = [
        'size' => 'array',
        'category' => 'array'
    ];
}
