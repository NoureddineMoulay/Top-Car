@extends('layouts.carh')
@section('title')
    Reservation Details
@endsection
@section('content')
        <div class="card-cont">
            <div class="imgas">
                <img src="{{asset('images/reservedetail.jpg')}}" alt="" height>
            </div>
            <div class="card-body">
                <h1>Reservation Details</h1>
                <div class="details-content">
                <p class="card-title" > Car Model: {{ $booking->car->model }}</p>
                <p class="card-text">Start Date: {{ $booking->start_date }}</p>
                <p class="card-text">End Date: {{ $booking->end_date }}</p>
                <p class="card-text">Total Price: ${{ $booking->total_price }}</p>


   @if($booking->status!='confirmed' && $booking->status!='cancelled')
        <div class="payment-section">
            <form action="{{ route('transactions.create-checkout-session') }}" method="POST">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button type="submit" class="btn btn-primary">Pay Now</button>
            </form>
            @if($booking->status === 'pending')
                <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-cancel">Cancel</button>
                </form>
                @endif
        </div>
        </div>
        @endif
           </div>
        </div>
@endsection
