@extends('layouts.carh')
@section('title')
    Reservation | {{ $car->model }}
@endsection
@section('content')
    <div class="container-reservation">
        <h1>Reserve Car</h1>


        <div class="form-reserve" >
            <div class="reserve-img">
                <img  src="{{ asset('images/reserve.jpg')}}"alt="">
            </div>

            <div class="formy">
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            @auth
                <input type="hidden" name="car_id" value="{{ $car->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @endauth

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" min="{{ now()->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" min="{{ now()->format('Y-m-d') }}" name="end_date" required>
            </div>

            <button type="submit" class="btn-book "> Book now !</button>
        </form>
            </div>
        </div>
    </div>
@endsection
