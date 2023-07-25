<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    use HasFactory;

    protected $table = 'products_images';

    protected $fillable = [
        'product_id',
        'title',
        'mime',
        'image'
    ];
}
