<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::create([
            'flight_number' => 'FL123',
            'user_id' => 1, // Assuming a passenger with ID 1 exists
            'seat_number' => 'A1',
            'price' => '200',
            'booking_date_time' => now(),
        ]);
    }
}
