<?php

namespace App\Models\Admin;

use App\Models\Admin\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    protected $fillable = [
        'sale_id',
        'file',
        'file_name',
        'mime',
        'hash',
    ];
}
