<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    // Tambahkan baris ini
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
    ];

    // Relasi One-to-Many dengan Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'flight_id', 'id');
    }

    // Relasi Many-to-Many dengan UserCustomer melalui tabel pivot save_flights
    public function savedByUsers()
    {
        return $this->belongsToMany(UserCustomer::class, 'save_flights', 'flight_id', 'user_id');
    }
}