@extends('layouts.carh')
@section('title')
    My Reservations
@endsection
@section('content')
    <div class="container-reservation">
        <h1>My Reservations</h1>
        <table class="reservations-table">
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
                    <td class="status {{ strtolower($booking->status) }}">{{ $booking->status }}</td>
                    <td>
                        <div class="ww"><a href="{{ route('bookings.show', $booking->id) }}"><i class="fa-solid fa-circle-info" style="color: var(--buttons);"></i></a>
                        @if($booking->status === 'pending')
                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display:inline;font-size: 12px;margin: 4px;">
                                @csrf
                                <button type="submit" ><i class="fa-solid fa-x" style="color:var(--buttons);"></i></button>
                            </form>
                        @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
