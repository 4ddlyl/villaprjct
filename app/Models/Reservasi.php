<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasis';

    protected $fillable = [
        'user_id',
        'villa_id',
        'checkin',
        'checkout',
        'total_harga',
        'bukti_pembayaran',  // sudah termasuk
        'status',
    ];

    protected $casts = [
        'checkin'  => 'date',
        'checkout' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'booking_id', 'id');
    }
}