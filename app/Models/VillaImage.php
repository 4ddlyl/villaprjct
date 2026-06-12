<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillaImage extends Model
{
    protected $table = 'villa_images';
    
    protected $fillable = [
        'villa_id', 'image_path', 'is_primary', 'sort_order'
    ];
    
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];
    
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}