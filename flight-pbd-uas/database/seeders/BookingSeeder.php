<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\UserCustomer; // Import model UserCustomer
use App\Models\Flight;       // Import model Flight

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // DB::table('bookings')->truncate(); // <-- Komentari/Hapus

        $users = UserCustomer::all();
        $flights = Flight::all(); // Ambil semua flights (termasuk 1500 data yang di-seed)

        if ($users->isEmpty() || $flights->isEmpty()) {
            $this->command->info('Tidak cukup data UserCustomer atau Flight untuk membuat Booking.');
            return;
        }

        // Buat 20 data booking
        for ($i = 0; $i < 20; $i++) {
            $user = $faker->randomElement($users);
            $flight = $faker->randomElement($flights);

            $departureDate = $faker->dateTimeBetween($flight->departure_time, (clone $flight->departure_time)->add(new \DateInterval('P1M')))->format('Y-m-d'); // Tanggal keberangkatan sesuai flight

            DB::table('bookings')->insert([
                'user_id' => $user->id,
                'flight_id' => $flight->id,
                'username' => $user->username, // Duplikasi data, seperti di SQL dump asli
                'flight_number' => $flight->flight_number, // Duplikasi data, seperti di SQL dump asli
                'departure_date' => $departureDate,
                'status' => $faker->randomElement(['completed', 'pending', 'cancelled', 'ongoing']),
                'order_id' => $faker->uuid, // Menggunakan UUID untuk order_id
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}