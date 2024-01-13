<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Flight extends Model
{
    use HasFactory;

    // Constants
    const AIRCRAFT_TYPE = [ 
        'Boeing 737' => '200',
        'Airbus A320' => '250',
        'Boeing 747' => '300',
        'Airbus A380' => '350'
    ];

    // protected $primaryKey = 'flight_number';
    protected $fillable = [
        'flight_number',
        'departure_city',
        'arrival_city',
        'departure_date_time',
        'arrival_date_time',
        'aircraft_type',
        'capacity',
    ];
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'flight_number', 'flight_number');
    }

    public function getDepartureDateTimeAttribute($value) {
        $carbonDate = Carbon::parse($value);
        return $carbonDate->format('M j, Y g:i A');
    }

    public function getArrivalDateTimeAttribute($value) {
        $carbonDate = Carbon::parse($value);
        return $carbonDate->format('M j, Y g:i A');
    }
}
