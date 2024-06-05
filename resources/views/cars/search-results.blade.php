@extends('layouts.carh')

@section('title', 'Search Results')

@section('content')
    <section class="section featured-car" id="featured-car" style="margin-top: 23px;">
        <div class="container">
            <div class="title-wrapper">
                <h2 class="h2 section-title">Search Result</h2>
                <a href="#" class="featured-car-link">
                    <span>View more</span>
                    <ion-icon name="arrow-forward-outline"></ion-icon>
                </a>
            </div>
            @if ($cars->count() > 0)
            <ul class="featured-car-list">
                @foreach($cars as $car)
                    <li>
                        <div class="featured-car-card">
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
                                    <!--<button class="btn rent-btn">Rent now</button>-->
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
@endsection

@section('styles')
    <style>
        .container-carseach {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            margin-top:120px;
        }

        .car-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .car-item {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
            padding: 20px;
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px 10px 0 0;
        }

        .car-details {
            padding: 20px;
        }

        .car-attributes {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .car-attribute {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #777;
        }

        .car-price {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

    </style>
@endsection

