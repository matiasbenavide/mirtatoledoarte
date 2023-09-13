<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacations',
        'price_update',
        'created_by',
        'updated_by',
    ];
}
