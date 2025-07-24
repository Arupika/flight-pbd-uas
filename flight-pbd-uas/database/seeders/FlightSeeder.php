<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokal Indonesia untuk data yang lebih relevan

        // Daftar nama maskapai yang umum
        $airlines = [
            'Garuda Indonesia',
            'Lion Air',
            'Citilink',
            'Batik Air',
            'Super Air Jet',
            'Sriwijaya Air',
            'TransNusa',
            'Pelita Air',
            'NAM Air',
            'Wings Air'
        ];

        // Daftar kota/bandara umum di Indonesia
        $airports = [
            'Jakarta (CGK)', 'Surabaya (SUB)', 'Denpasar (DPS)', 'Yogyakarta (JOG)',
            'Medan (KNO)', 'Makassar (UPG)', 'Bandung (BDO)', 'Semarang (SRG)',
            'Palembang (PLM)', 'Pekanbaru (PKU)', 'Balikpapan (BPN)', 'Manado (MDC)',
            'Batam (BTH)', 'Padang (PDG)', 'Lombok (LOP)', 'Pontianak (PNK)',
            'Banjarmasin (BDJ)', 'Kendari (KDI)', 'Ambon (AMQ)', 'Jayapura (DJJ)'
        ];

        // Kosongkan tabel flights sebelum seeding, agar tidak duplikasi jika dijalankan berulang
        // HATI-HATI: Ini akan menghapus semua data yang ada di tabel flights!
       // DB::table('flights')->truncate();

        for ($i = 0; $i < 1500; $i++) {
            $departureTime = $faker->dateTimeBetween('now', '+1 year'); // Waktu keberangkatan dalam 1 tahun ke depan
            $arrivalTime = (clone $departureTime)->add(new \DateInterval('PT' . $faker->numberBetween(1, 6) . 'H' . $faker->numberBetween(0, 59) . 'M')); // Durasi penerbangan 1-6 jam

            // Pastikan departure dan destination berbeda
            $departure = $faker->randomElement($airports);
            $destination = $faker->randomElement(array_diff($airports, [$departure]));

            DB::table('flights')->insert([
                'flight_number' => 'FL' . $faker->unique()->numberBetween(1000, 9999), // Nomor penerbangan unik FL1000 - FL9999
                'airline' => $faker->randomElement($airlines),
                'departure' => $departure,
                'destination' => $destination,
                'departure_time' => $departureTime,
                'arrival_time' => $arrivalTime,
                'price' => $faker->randomFloat(2, 500000, 5000000), // Harga antara 500rb - 5jt
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}