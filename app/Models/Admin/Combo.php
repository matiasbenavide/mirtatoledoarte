<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = [
        'name',
        'price',
        'products',
        'description',
        'material',
        'size',
        'max_weight',
        'category_id',
        'color_id',
        'created_by',
        'updated_by',
    ];
}
