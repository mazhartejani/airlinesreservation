@extends('layouts.app')
@section('title', $title)

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h4 class="card-header">
                    {{$title}}
                </h4>
                <div class="card-body">
                    <table class="table table-striped table-hover text-center">
                        <thead>
                            <tr>
                            <th scope="col">Passenger</th>
                            <th scope="col">Flight No#</th>
                            <th scope="col">Ticket No#</th>
                            <th scope="col">Seat</th>
                            <th scope="col">Price</th>
                            <th scope="col">Departure Time</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tickets as $ticket)                            
                                <tr>
                                    <th>{{$ticket['passenger']['name']}}</th>
                                    <td>{{$ticket['flight_number']}}</td>
                                    <td>{{$ticket['ticket_number']}}</td>
                                    <td>{{$ticket['seat_number']}}</td>
                                    <th>{{$ticket['price']}}</th>
                                    <th>{{$ticket['booking_date_time']}}</th>
                                    <td>
                                        @if($ticket['status'] == 'cancelled')
                                            <span class="badge rounded-pill bg-danger p-2">{{strtoupper($ticket['status'])}}</span>
                                        @else
                                            <span class="badge rounded-pill bg-success p-2">{{strtoupper($ticket['status'])}}</span>
                                        @endif
                                    </td>
                                    <td scope="row">
                                        @if(auth()->user()->is_admin)
                                            <a href="{{route('updateTicketStatus', ['ticket_number' => $ticket['ticket_number'], 'status' => 'confirmed'])}}" class="btn btn-sm btn-success">
                                                Confirm
                                            </a>
                                        @endif
                                        
                                        <a href="{{route('updateTicketStatus', ['ticket_number' => $ticket['ticket_number'], 'status' => 'cancelled'])}}" class="btn btn-sm btn-warning">
                                            Cancel
                                        </a>
                                    </td>
                                </tr>

                            @empty
                            <td colspan="8">
                                No Data
                            </td>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $tickets->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection