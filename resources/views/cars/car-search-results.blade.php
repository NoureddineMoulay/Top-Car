<!-- search-results.blade.php -->

@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="container">
        <h2>Search Results</h2>

        @if ($cars->count() > 0)
            <div class="car-list">
                @foreach ($cars as $car)
                    <div class="car-item">
                        <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->name }}">
                        <h3>{{ $car->name }}</h3>
                        <p>Brand: {{ $car->make }}</p>
                        <p>Price per Day: ${{ $car->rental_price_per_day }}</p>
                        <p>Location: {{ $car->location }}</p>
                        <a href="{{ route('cars.show', $car) }}" class="btn">View Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <p>No cars found matching your search criteria.</p>
        @endif
    </div>
@endsection
