<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;
use App\Models\Seat;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert sample data
        $flight = Flight::create([
            'flight_number' => 'FL123',
            'departure_city' => 'New York',
            'arrival_city' => 'Los Angeles',
            'departure_date_time' => now(),
            'arrival_date_time' => now()->addHours(3),
            'aircraft_type' => 'Boeing 737',
            'capacity' => '200',
        ]);

        $rows = range('A', 'Z'); // Alphabetic rows, adjust as needed
        $columns = 10;

        $createdSeats = 0;

        foreach ($rows as $row) {
            for ($column = 1; $column <= $columns; $column++) {
                if ($createdSeats >= $flight->capacity) {
                    break 2; // Exit both loops when the desired number of seats is reached
                }

                Seat::create([
                    'flight_number' => $flight->flight_number,
                    'seat_number' => $row . $column,
                ]);

                $createdSeats++;
            }
        }
    }
}
