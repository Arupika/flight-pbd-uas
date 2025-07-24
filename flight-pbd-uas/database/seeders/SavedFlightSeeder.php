<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\UserCustomer; // Import model UserCustomer
use App\Models\Flight;       // Import model Flight

class SavedFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // DB::table('save_flights')->truncate(); // <-- Komentari/Hapus

        $users = UserCustomer::all();
        $flights = Flight::all();

        if ($users->isEmpty() || $flights->isEmpty()) {
            $this->command->info('Tidak cukup data UserCustomer atau Flight untuk membuat SavedFlight.');
            return;
        }

        $insertedCombinations = []; // Untuk melacak kombinasi unik

        // Buat 20 data saved flights
        for ($i = 0; $i < 20; $i++) {
            $userId = $faker->randomElement($users)->id;
            $flightId = $faker->randomElement($flights)->id;

            // Pastikan kombinasi user_id dan flight_id unik (karena ada unique constraint)
            if (!in_array([$userId, $flightId], $insertedCombinations)) {
                try {
                    DB::table('save_flights')->insert([
                        'user_id' => $userId,
                        'flight_id' => $flightId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $insertedCombinations[] = [$userId, $flightId];
                } catch (\Illuminate\Database\QueryException $e) {
                    // Jika terjadi duplikasi meskipun sudah dicek, lewati dan coba lagi di iterasi berikutnya
                    // Ini bisa terjadi jika ada race condition atau faker menghasilkan yang sama berurutan
                    $this->command->info("Duplikasi SavedFlight ditemukan, mencoba lagi: " . $e->getMessage());
                    $i--; // Coba lagi di iterasi yang sama
                }
            } else {
                $i--; // Jika kombinasi sudah ada, coba lagi di iterasi yang sama
            }
        }
    }
}