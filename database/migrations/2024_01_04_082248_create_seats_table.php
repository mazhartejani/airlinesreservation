<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Seat;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->string('flight_number');
            $table->string('seat_number');
            $table->boolean('is_available')->default(true);
            $table->foreign('flight_number')->references('flight_number')->on('flights');
            $table->timestamps();
        });

        $rows = ['A', 'B', 'C', 'D', 'E'];
        $columns = 6;

        foreach ($rows as $row) {
            for ($column = 1; $column <= $columns; $column++) {
                Seat::create([
                    'flight_number' => 'ABC222',
                    'seat_number' => $row . $column,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
