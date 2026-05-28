<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'booking_id',
        'metode',
        'bukti_pembayaran',
        'status',
        'catatan_penolakan',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'booking_id', 'id');
    }
}