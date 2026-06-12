<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $table = 'villas';

    protected $fillable = [
        'nama_villa',
        'lokasi',
        'harga_per_malam',
        'kapasitas',
        'jumlah_kamar',
        'fasilitas',
        'status',
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class, 'villa_id');
    }

    public function images()
    {
        return $this->hasMany(VillaImage::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(VillaImage::class)->where('is_primary', true);
    }

    public function getFirstImageAttribute()
    {
        return $this->images->first()->image_path ?? null;
    }
}
