<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'color',
        'created_by',
        'updated_by',
    ];
}
