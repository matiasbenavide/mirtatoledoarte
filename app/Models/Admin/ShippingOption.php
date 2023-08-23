<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
