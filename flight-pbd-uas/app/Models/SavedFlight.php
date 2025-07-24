<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedFlight extends Model
{
    use HasFactory;

    protected $table = 'save_flights'; // Pastikan nama tabel sesuai

    // Jika Anda perlu mengakses user atau flight dari SavedFlight itu sendiri
    public function user()
    {
        return $this->belongsTo(UserCustomer::class, 'user_id', 'id');
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }
}