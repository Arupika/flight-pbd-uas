<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Pastikan nama tabel sesuai

    // Relasi Many-to-One dengan Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'id');
    }

    // Relasi Many-to-One dengan UserCustomer (jika diperlukan untuk melacak siapa yang bayar, meski sudah ada di booking)
    public function user()
    {
        return $this->belongsTo(UserCustomer::class, 'user_id', 'id');
    }
}