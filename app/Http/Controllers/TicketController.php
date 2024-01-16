<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Ticket;
use App\Models\Seat;
use Carbon\Carbon;
use Auth;

class TicketController extends Controller
{
    public function reserveTicketForm() {
        $flights = Flight::pluck('flight_number')->toArray();
        return view('pages.reservation', compact('flights'));
    }

    // Admin function
    public function getAllTickets() {
        $user = Auth::user();
        $title = 'Booking History';

        if($user->is_admin) {
            $tickets = Ticket::with('passenger')->orderBy('ticket_number','desc')->paginate(5);
            $title = 'Tickets';
        } else {
            $tickets = Ticket::with('passenger')->where('user_id', $user->id)->orderBy('ticket_number','desc')->paginate(5);
        }
        
        return view('pages.tickets.tickets', compact('tickets', 'title'));
    }

    public function updateTicketStatus($ticket_number, $status) {
        $ticket = Ticket::find($ticket_number);
        $ticket->status = $status;
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket ' .  $status . ' created successfully!');
    }


    public function reserveTicket(Request $request)
    {
        // Validate user input
        $request->validate([
            'flight_number' => 'required',
            'date' => 'required|date',
            'seat_preference' => 'required',
        ]);

        // Get flight details
        $flightNumber = $request->input('flight_number');
        $date = $request->input('date');
        $seatPreference = $request->input('seat_preference');

        // Check seat availability
        $availableSeats = $this->checkSeatAvailability($flightNumber, $date);

        // Check if the preferred seat is available
        if (!in_array($seatPreference, $availableSeats)) {
            return redirect()->back()->with('error', 'Preferred seat is not available.');
        }

        // Reserve the seat
        $ticket = $this->reserveSeat($flightNumber, $date, $seatPreference);

        // Provide a confirmation message with reservation details
        return redirect()->back()->with('success', 'Reservation successful.')->with('ticket', $ticket);
    }

    public function cancelReservation(Request $request)
    {
        // Validate user input
        $request->validate([
            'reservation_code' => 'required', // You can modify this based on your reservation identification method
        ]);

        // Get reservation details
        $reservationCode = $request->input('reservation_code');

        // Find the ticket based on the reservation code
        $ticket = Ticket::where('reservation_code', $reservationCode)->first();

        // Check if the ticket exists
        if (!$ticket) {
            return response()->json(['message' => 'Reservation not found.'], 404);
        }

        // Confirm cancellation with the user
        $confirmationMessage = $this->confirmCancellation($ticket);

        // Update the system to mark the seat as available again
        $this->markSeatAsAvailable($ticket);

        // Send a cancellation confirmation to the user
        $this->sendCancellationConfirmation($ticket);

        return response()->json(['message' => $confirmationMessage]);
    }

    private function checkSeatAvailability($flightNumber, $date) {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return response()->json(['message' => 'Unauthorized. Please log in.'], 401);
        }

        // $date = DateTime::createFromFormat('Y-m-d\TH:i', $date)->format('Y-m-d H:i:s');

        $carbonDatetime = Carbon::createFromFormat('Y-m-d\TH:i', $date);
        $date = $carbonDatetime->format('Y-m-d H:i:s');
        $fromDate = $carbonDatetime->format('Y-m-d 00:00:00');
        $toDate = $carbonDatetime->format('Y-m-d 23:59:59');


        // Retrieve the list of reserved seats for the specified flight and date
        $reservedSeats = Ticket::where('flight_number', $flightNumber)
        ->whereBetween('booking_date_time', [$fromDate,$toDate])
        ->pluck('seat_number')
        ->toArray();
            

        // Define the total seats available for the flight (replace with your actual logic)
        $totalSeats = Seat::where('flight_number', $flightNumber)->pluck('seat_number')->toArray();

        // Calculate available seats by removing reserved seats from the total seats
        $availableSeats = array_diff($totalSeats, $reservedSeats);

        return $availableSeats;
    }


    private function reserveSeat($flightNumber, $date, $seatPreference)
    {
        // Create a new ticket record in the database
        $ticket = Ticket::create([
            'seat_number' => $seatPreference,
            'price' => 100.00, // You may set the actual price based on your system
            'booking_date_time' => $date,
            'flight_number' => $flightNumber,
            'status' => 'pending', // Set the default status
            'user_id' => auth()->user()->id, // Assuming you have a user authentication system
        ]);

        return $ticket;
    }

    private function confirmCancellation($ticket)
    {
        // You can customize this method to provide additional confirmation details
        // For example, display the flight details, seat number, etc.

        return 'Are you sure you want to cancel the reservation for seat ' . $ticket->seat_number . '?';
    }

    private function markSeatAsAvailable($ticket)
    {
        // Update the ticket record to mark the seat as available
        $ticket->update(['status' => 'available']);
    }

    private function sendCancellationConfirmation($ticket)
    {
        // You can implement logic to send a cancellation confirmation to the user
        // For example, sending an email or notification

        // For demonstration purposes, let's assume we're sending a response in JSON
        return response()->json(['message' => 'Cancellation confirmation sent to the user.']);
    }
}
