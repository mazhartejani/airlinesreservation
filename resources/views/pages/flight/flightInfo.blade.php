@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Flight Information</div>

                <div class="card-body">
                    <form action="{{ route('flightSearch') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="flight_number">Flight Number / Destination</label>
                            <input type="text" class="form-control" id="flight_number" name="search_term" required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Get Flight Information</button>
                    </form>
                    @isset($flightInformation)
                        <div class="mt-4">
                            @foreach($flightInformation as $flightInformation)
                            <h2>Flight Number: {{$flightInformation['flight_number']}}</h2>
                            <ul>
                                <li><strong>Departure Time:</strong> {{ $flightInformation['departure_date_time'] }}</li>
                                <li><strong>Arrival Time:</strong> {{ $flightInformation['arrival_date_time'] }}</li>
                                <li><strong>Available Seats:</strong> {{ $flightInformation['available_seats'] }}</li>
                                <li><strong>Airline:</strong> {{ $flightInformation['aircraft_type'] }}</li>
                                <li><strong>Departure City:</strong> {{ $flightInformation['departure_city'] }}</li>
                                <li><strong>Arrival City:</strong> {{ $flightInformation['arrival_city'] }}</li>
                                <!-- Add other relevant details -->
                            </ul>
                            @endforeach
                        </div>
                    @endisset
                    @isset($error)
                        <div class="mt-4">
                            <h2>{{ $error }}</h2>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
