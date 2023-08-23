<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    const WITH_COLOR = 1;
    const WITHOUT_COLOR = 2;

    protected $fillable = [
        'color',
        'created_by',
        'updated_by',
    ];
}
