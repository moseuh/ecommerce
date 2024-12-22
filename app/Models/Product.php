<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default pluralized form of the model name
    protected $table = 'products';

    // Define the fillable attributes
    protected $fillable = [
        'name',
        'price',
        'category',
        'description',
        'gallery',
    ];
}
