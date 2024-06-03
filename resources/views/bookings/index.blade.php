@extends('layouts.carh')
@section('title')
    My Reservations
@endsection
@section('content')
    <div class="container-reservation">
        <h1>My Reservations</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Car</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Price</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->car->model }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td>{{ $booking->total_price }}</td>
                    <td>{{ $booking->status }}</td>
                    <td> <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info">View Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
