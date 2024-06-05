@extends('layouts.carh')

@section('title')
    Our Cars
@endsection

@section('content')
    <h2 style="position: relative; top: 72px; margin-bottom: 16px; margin-left: 80px;">Our Featured Cars</h2>
    <div class="filter-featured">
        <aside class="filter">
            <h2>Search with filter</h2>
            <form action="{{ route('cars.allcars') }}" method="GET">
                <div class="filter-group">
                    <label for="seats">
                        <ion-icon name="people-outline"></ion-icon> Number of Seats
                    </label>
                    <select name="seats" id="seats">
                        <option value="">Any</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="fuel">
                        <ion-icon name="flash-outline"></ion-icon> Fuel Type
                    </label>
                    <select name="fuel" id="fuel">
                        <option value="">Any</option>
                        <option value="Petrol">Petrol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybrid">Hybrid</option>
                        <option value="Electric">Electric</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="transmission">
                        <ion-icon name="hardware-chip-outline"></ion-icon> Transmission
                    </label>
                    <select name="transmission" id="transmission">
                        <option value="">Any</option>
                        <option value="Automatic">Automatic</option>
                        <option value="Manual">Manual</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="year">
                        <ion-icon name="calendar-outline"></ion-icon> Year
                    </label>
                    <select name="year" id="year">
                        <option value="">Any</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="filter-group">
                    <label for="status">
                        <ion-icon name="checkmark-circle-outline"></ion-icon> Status
                    </label>
                    <select name="status" id="status">
                        <option value="">Any</option>
                        <option value="available">Available</option>
                        <option value="rented">Unavailable</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Apply Filters</button>
            </form>
        </aside>
        <section class="section featured-car" id="featured-car" style="margin-top: 23px;">
            <div class="container">
                @if ($cars->count() > 0)
                    <ul class="featured-car-list">
                        @foreach($cars as $car)
                            <li>
                                <div class="featured-car-card {{ $car->status != 'available' ? 'low-opacity' : '' }}">
                                    <figure class="card-banner">
                                        <img src="{{ asset($car->first_image()->image_path) }}" alt="{{ $car->model }}" loading="lazy" width="440" height="300" class="w-100">
                                    </figure>
                                    <div class="card-content">
                                        <div class="card-title-wrapper">
                                            <h3 class="h3 card-title">
                                                <a href="#">{{ $car->model }}</a>
                                            </h3>
                                            <data class="year" value="{{ $car->year }}">{{ $car->year }}</data>
                                        </div>
                                        <ul class="card-list">
                                            <li class="card-list-item">
                                                <ion-icon name="people-outline"></ion-icon>
                                                <span class="card-item-text">{{ $car->number_of_seats }} People</span>
                                            </li>
                                            <li class="card-list-item">
                                                <ion-icon name="flash-outline"></ion-icon>
                                                <span class="card-item-text">{{ $car->fuel_type }}</span>
                                            </li>
                                            <li class="card-list-item">
                                                <ion-icon name="speedometer-outline"></ion-icon>
                                                <span class="card-item-text">{{ $car->consumption }} km / 1-litre</span>
                                            </li>
                                            <li class="card-list-item">
                                                <ion-icon name="hardware-chip-outline"></ion-icon>
                                                <span class="card-item-text">{{ $car->transmission }}</span>
                                            </li>
                                        </ul>
                                        <div class="card-price-wrapper">
                                            <p class="card-price">
                                                <strong>${{ $car->rental_price_per_day }}</strong> / day
                                            </p>
                                            <a href="{{ route('cars.show', $car) }}" class="btn rent-btn">Rent now</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>No cars found matching your search criteria.</p>
                @endif
            </div>
        </section>
    </div>
@endsection

@section('styles')
    <style>
        .low-opacity {
            opacity: 0.5;
        }
    </style>
@endsection
