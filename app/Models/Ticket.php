<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $primaryKey = 'ticket_number';
    public $guarded = ['ticket_number'];

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_number', 'flight_number');
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
