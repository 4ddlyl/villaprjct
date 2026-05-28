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
}