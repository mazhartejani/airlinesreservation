@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Flight</div>
                
                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
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

                <div class="card-body">
                    <form action="{{ route('flights.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group mt-3">
                                <label for="flight_number">Flight Number</label>
                                <input type="text" class="form-control @error('flight_number') is-invalid @enderror" id="flight_number" name="flight_number" placeholder="E.g., ABC123" value="{{ old('flight_number') }}" required>
                                @error('flight_number')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group mt-3">
                                <label for="departure_city">Departure City</label>
                                <input type="text" class="form-control @error('departure_city') is-invalid @enderror" id="departure_city" name="departure_city" placeholder="E.g., New York" value="{{ old('departure_city') }}" required>
                                @error('departure_city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group mt-3">
                                <label for="arrival_city">Arrival City</label>
                                <input type="text" class="form-control @error('arrival_city') is-invalid @enderror" id="arrival_city" name="arrival_city" placeholder="E.g., Los Angeles" value="{{ old('arrival_city') }}" required>
                                @error('arrival_city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group mt-3">
                                <label for="aircraft_type">Aircraft Type</label>
                                <input type="text" class="form-control @error('aircraft_type') is-invalid @enderror" id="aircraft_type" name="aircraft_type" placeholder="E.g., Boeing 737" value="{{ old('aircraft_type') }}" required>
                                @error('aircraft_type')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group mt-3">
                                <label for="capacity">Capacity</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" placeholder="E.g., 150" value="{{ old('capacity') }}" required>
                                @error('capacity')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="departure_date_time">Departure Date and Time</label>
                                <input type="datetime-local" class="form-control @error('departure_date_time') is-invalid @enderror" id="departure_date_time" name="departure_date_time" value="{{ old('departure_date_time') }}" required>
                                @error('departure_date_time')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <label for="arrival_date_time">Arrival Date and Time</label>
                                <input type="datetime-local" class="form-control @error('arrival_date_time') is-invalid @enderror" id="arrival_date_time" name="arrival_date_time" value="{{ old('arrival_date_time') }}" required>
                                @error('arrival_date_time')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Create Flight</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
