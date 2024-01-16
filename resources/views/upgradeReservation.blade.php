@extends('layouts.app') <!-- Assuming you have a Blade layout -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-2" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-2" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="card flash-message" style="border-radius: 0">
                        <div class="alert alert-danger alert-dismissible m-3" role="alert">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <div class="card-header">Ticket Search</div>
                <div class="card-body">
                    <form  class="mb-3" action="{{ route('searchTicket') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <label for="ticket_number">Ticket Number</label>
                            <input type="text" class="form-control" id="ticket_number" name="ticket_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Search Ticket</button>
                    </form>
                </div>
            </div>
            @if(isset($ticket))
            <div class="card mt-3">
                <div class="card-header">Upgrade Seat</div>
                <div class="card-body">
                    <form action="{{route('upgradeSeat')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="flight_number">Flight Number</label>
                            <input type="text" class="form-control disabled" readonly id="flight_number" value="{{isset($ticket) ? $ticket->flight_number : ''}}" name="flight_number">
                            <input class="d-none" type="datetime-local" id="booking_date_time" name="booking_date_time" value="{{ old('booking_date_time', $ticket->booking_date_time) }}">
                            <input type="hidden" value="{{isset($ticket) ? $ticket->ticket_number : ''}}" name="ticket_number">
                        </div>
                        <div class="form-group mb-3">
                            <label for="seat_preference">Seat Preference</label>
                            <input type="text" class="form-control" id="seat_preference" value="{{isset($ticket) ? $ticket->seat_number : ''}}" name="seat_preference" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upgrade Seat</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
