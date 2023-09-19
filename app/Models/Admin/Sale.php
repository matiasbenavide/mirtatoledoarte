<?php

namespace App\Models\Admin;

use App\Models\Admin\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'document_number',
        'products',
        'combos',
        'total_amount',
        'shipping_option',
        'direction',
        'province',
        'locality',
        'zip_code',
        'reference_code',
        'created_by',
    ];

    public function files()
    {
        return $this->hasMany('App\Models\Operative\Receipt', 'sale_id', 'id')->select('id', 'sale_id', 'file_name');
    }
}
