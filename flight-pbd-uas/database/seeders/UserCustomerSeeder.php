<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\UserCustomer; // Import model UserCustomer

class UserCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Hapus data lama agar tidak duplikasi (opsional jika selalu pakai migrate:fresh)
        // DB::table('user_customers')->truncate(); // <-- Komentari/Hapus jika selalu pakai migrate:fresh

        // Tambahkan 20 data dummy
        for ($i = 0; $i < 20; $i++) {
            UserCustomer::create([ // Menggunakan Eloquent Model untuk create
                'username' => $faker->userName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Password standar 'password'
                'phone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}