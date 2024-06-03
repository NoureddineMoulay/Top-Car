@extends('layouts.carh')

@section('content')
    <div class="container">
        <h1>Reservation Details</h1>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Car Model: {{ $booking->car->model }}</h5>
                <p class="card-text">Start Date: {{ $booking->start_date }}</p>
                <p class="card-text">End Date: {{ $booking->end_date }}</p>
                <p class="card-text">Total Price: ${{ $booking->total_price }}</p>
            </div>
        </div>

        <div id="payment-section">
            <form action="{{ route('transactions.create-checkout-session') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
        </div>
    </div>
@endsection
