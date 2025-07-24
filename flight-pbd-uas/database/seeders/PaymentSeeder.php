<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Booking; // Import model Booking
use App\Models\UserCustomer; // Import model UserCustomer

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // DB::table('payments')->truncate(); // <-- Komentari/Hapus

        $bookings = Booking::all();
        $users = UserCustomer::all(); // Diperlukan karena payments juga punya user_id di skema Anda

        if ($bookings->isEmpty() || $users->isEmpty()) {
            $this->command->info('Tidak cukup data Booking atau UserCustomer untuk membuat Payment.');
            return;
        }

        // Buat 20 data payment
        for ($i = 0; $i < 20; $i++) {
            $booking = $faker->randomElement($bookings);
            // Coba ambil user dari booking, jika tidak ada, ambil random user
            $user = $booking->user ?? $faker->randomElement($users);

            // Jika booking sudah memiliki order_id, gunakan itu, atau buat baru
            $orderId = $booking->order_id ?? $faker->uuid;
            $amount = $booking->flight->price * 1.02; // Contoh: harga flight + 2% biaya admin

            DB::table('payments')->insert([
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'order_id' => $orderId,
                'transaction_id' => 'TRX-' . $faker->unique()->randomNumber(9), // Contoh ID transaksi unik
                'payment_type' => $faker->randomElement(['credit_card', 'bank_transfer', 'e-wallet']),
                'amount' => $amount,
                'status' => $faker->randomElement(['capture', 'pending', 'failed']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}