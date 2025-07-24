<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles'; // Pastikan nama tabel sesuai

    // Relasi One-to-One dengan UserCustomer
    public function user()
    {
        return $this->belongsTo(UserCustomer::class, 'user_id', 'id');
    }
}