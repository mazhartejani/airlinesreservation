@extends('layouts.app') <!-- Assuming you have a Blade layout -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reservation Form</div>
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

                <div class="card-body">
                    <form action="{{route('reserveTicket')}}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="flight_number">Flight Number</label>
                            <select class="form-select" name="flight_number" id="flight_number">
                                @foreach($flights as $flight) 
                                    <option value="{{$flight}}">{{$flight}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="date">Date</label>
                            <!-- <input type="date" class="form-control" id="date" name="date" required> -->
                            <input type="datetime-local" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="seat_preference">Seat Preference</label>
                            <input type="text" class="form-control" id="seat_preference" name="seat_preference" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reserve Ticket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
