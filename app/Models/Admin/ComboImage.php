<?php

namespace App\Models\Admin;

use App\Models\Admin\Combo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComboImage extends Model
{
    use HasFactory;

    protected $table = 'combos_images';

    protected $fillable = [
        'combo_id',
        'image',
    ];

    public function combo()
    {
        return $this->belongsTo(Combo::class);
    }
}
