<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings'; // Pastikan nama tabel sesuai

    // Relasi Many-to-One dengan UserCustomer
    public function user()
    {
        return $this->belongsTo(UserCustomer::class, 'user_id', 'id');
    }

    // Relasi Many-to-One dengan Flight
    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }

    // Relasi One-to-Many dengan Payment (satu booking bisa punya banyak payment, atau satu jika sudah final)
    public function payments()
    {
        return $this->hasMany(Payment::class, 'booking_id', 'id');
    }
}