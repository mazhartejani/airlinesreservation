@extends('layouts.app') <!-- Assuming you have a Blade layout -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reservation Form</div>

                <div class="card-body">
                    <form action="{{route('reserveTicket')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="flight_number">Flight Number</label>
                            <input type="text" class="form-control" id="flight_number" name="flight_number" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="seat_preference">Seat Preference</label>
                            <input type="text" class="form-control" id="seat_preference" name="seat_preference" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Reserve Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
