<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserCustomerSeeder::class,
            UserProfileSeeder::class, // Bergantung pada UserCustomer
            FlightSeeder::class,
            BookingSeeder::class,     // Bergantung pada UserCustomer dan Flight
            PaymentSeeder::class,     // Bergantung pada Booking dan UserCustomer
            SavedFlightSeeder::class, // Bergantung pada UserCustomer dan Flight
        ]);
    }
}