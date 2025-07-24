<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomer extends Model
{
    use HasFactory;

    protected $table = 'user_customers'; // Pastikan nama tabel sesuai

    // Relasi One-to-One dengan UserProfile
    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    // Relasi One-to-Many dengan Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }

    // Relasi One-to-Many dengan Payment (jika user bisa melakukan banyak pembayaran langsung)
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    // Relasi Many-to-Many dengan Flight melalui tabel pivot save_flights
    public function savedFlights()
    {
        return $this->belongsToMany(Flight::class, 'save_flights', 'user_id', 'flight_id');
    }
}