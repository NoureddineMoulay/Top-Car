@extends('layouts.carh')
@section('title')
    Reservation | {{$car->model}}
@endsection
@section('content')
    <div class="container-reservation">
        <h1>Reserve Car</h1>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            @auth
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endauth

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>

            <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="number" class="form-control" id="total_price" name="total_price" required>
            </div>

            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>
@endsection
