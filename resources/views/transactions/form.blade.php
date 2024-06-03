@extends('layouts.carh')
@section('title')
 Payment
@endsection
@section('content')
    <div class="container">
        <h1>Payment</h1>
        <form action="{{ route('transactions.process') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
            <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="{{ env('STRIPE_KEY') }}"
                    data-amount="{{ $booking->total_price * 100 }}"
                    data-name="Car Rental"
                    data-description="Car rental payment"
                    data-email="{{ Auth::user()->email }}"
                    data-currency="usd"></script>
        </form>
    </div>
@endsection
