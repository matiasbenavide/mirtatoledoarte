<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    const SHIP = 1;
    const WITHDRAW = 2;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];
}
