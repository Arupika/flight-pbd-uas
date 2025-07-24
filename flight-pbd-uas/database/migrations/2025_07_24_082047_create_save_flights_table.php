<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_customers')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'flight_id']); // Menjamin hanya satu entri per pasangan user-flight
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('save_flights');
    }
};