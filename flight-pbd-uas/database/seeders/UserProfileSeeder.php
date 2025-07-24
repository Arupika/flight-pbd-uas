<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\UserCustomer; // Import model UserCustomer

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // DB::table('user_profiles')->truncate(); // <-- Komentari/Hapus

        $users = UserCustomer::all(); // Ambil semua user yang sudah di-seed

        foreach ($users as $user) {
            DB::table('user_profiles')->insert([
                'user_id' => $user->id,
                'full_name' => $faker->name,
                'address' => $faker->address,
                'date_of_birth' => $faker->date('Y-m-d', '2005-01-01'), // Usia max sekitar 20 tahun
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}