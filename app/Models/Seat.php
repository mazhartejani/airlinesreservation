<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = ['flight_number', 'seat_number', 'is_available'];

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
