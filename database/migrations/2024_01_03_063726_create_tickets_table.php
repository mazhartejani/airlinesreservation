<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id('ticket_number');
            $table->string('seat_number');
            $table->decimal('price', 8, 2);
            $table->dateTime('booking_date_time');
            $table->string('flight_number');
            $table->foreignId('user_id')->constrained();
            $table->foreign('flight_number')->references('flight_number')->on('flights');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
