<?php

namespace App\Models\Admin;

use App\Models\Admin\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'material',
        'size',
        'max_weight',
        'category_id',
        'color_id',
        'created_by',
        'updated_by',
    ];

    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
}
