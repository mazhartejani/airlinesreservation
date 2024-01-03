<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    protected $primaryKey = 'flight_number';
    public $guarded = ['ticket_number'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'flight_number', 'flight_number');
    }
}
