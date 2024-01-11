<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Seat;
use DB;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('pages.flight.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.flight.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate user input
        $request->validate([
            'flight_number' => 'required|unique:flights,flight_number',
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'departure_date_time' => 'required|date',
            'arrival_date_time' => 'required|date|after:departure_date_time',
            'aircraft_type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();

        try {
            // Create a new flight record in the database
            $flight = Flight::create([
                'flight_number' => $request->input('flight_number'),
                'departure_city' => $request->input('departure_city'),
                'arrival_city' => $request->input('arrival_city'),
                'departure_date_time' => $request->input('departure_date_time'),
                'arrival_date_time' => $request->input('arrival_date_time'),
                'aircraft_type' => $request->input('aircraft_type'),
                'capacity' => $request->input('capacity'),
            ]);

            if($flight){
                $this->createSeats($flight->flight_number, $request->capacity);
            }

            DB::commit();

        } catch(Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        
        return redirect()->back()->with('success', 'Flight created successfully.');
    }

    private function createSeats($flightNumber, $capacity) {
        $rows = range('A', 'Z'); // Alphabetic rows, adjust as needed
        $columns = 10;

        $createdSeats = 0;

        foreach ($rows as $row) {
            for ($column = 1; $column <= $columns; $column++) {
                if ($createdSeats >= $capacity) {
                    break 2; // Exit both loops when the desired number of seats is reached
                }

                Seat::create([
                    'flight_number' => $flightNumber,
                    'seat_number' => $row . $column,
                ]);

                $createdSeats++;
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function flightSearchForm() {
        return view('pages.flight.flightInfo');
    }

    public function showFlightInformation(Request $request)
    {
        // Validate user input
        $request->validate([
            'search_term' => 'required|string', // Adjust validation rules as needed
        ]);

        // Retrieve flight information based on the flight number or arrival city
        $flightInformation = Flight::where('flight_number', $request->input('search_term'))
            ->orWhere('arrival_city', $request->input('search_term'))
            ->get();

        if (!$flightInformation) {
            return view('pages.flight.flightInfo')->with('error', 'Flight not found.');
        }
        
        return view('pages.flight.flightInfo')->with('flightInformation', $flightInformation);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
