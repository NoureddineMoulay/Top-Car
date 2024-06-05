@extends('layouts.carh')
@section('title')
    Welcome to Our Car Rental System
@endsection
@section('content')
    <article>
        <!-- HERO Section -->
        <section class="section hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-title">Rent & Reserve <span>reputable cars</span></div>
                    <p class="hero-text">Live in New York, New Jersey, and Connecticut!</p>
                </div>
                <div class="hero-banner"></div>
                <form action="{{ route('cars.search') }}" method="GET" class="hero-form">
                    <div class="input-wrapper">
                        <input type="text" name="brand" id="input-1" class="input-field" placeholder="Brand">
                        <span><i class="fa-solid fa-car"></i></span>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="price" id="input-2" class="input-field" placeholder="Price">
                        <span><i class="fa-solid fa-dollar-sign"></i></span>
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="location" id="input-3" class="input-field" placeholder="Location">
                        <span><i class="fa-solid fa-location-dot"></i></span>
                    </div>
                    <button type="submit" class="btn">Search</button>
                </form>
            </div>
        </section>

        <!-- Carousel Section -->
        <div class="carousel" id="carousel" role="region" aria-label="Logo Carousel">
            <div class="carousel-container" id="carouselContainer" role="list">
                <div class="carousel-item" role="listitem"><img src="./images/bmw.png" alt=""></div>
                <div class="carousel-item" role="listitem"><img src="./images/ferrari.png" alt=""></div>
                <div class="carousel-item" role="listitem"><img src="./images/kia.png" alt=""></div>
                <div class="carousel-item" role="listitem"><img src="./images/mercedes.png" alt=""></div>
                <div class="carousel-item" role="listitem"><img src="./images/tesla.png" alt=""></div>
                <div class="carousel-item" role="listitem"><img src="./images/audi.png" alt=""></div>
            </div>
        </div>

        <!-- Featured Car Section -->
        <section class="section featured-car" id="featured-car">
            <div class="container">
                <div class="title-wrapper">
                    <h2 class="h2 section-title">Featured cars</h2>
                    <a href="#" class="featured-car-link">
                        <span>View more</span>
                        <ion-icon name="arrow-forward-outline"></ion-icon>
                    </a>
                </div>
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
                                        <!--<button class="btn rent-btn">Rent now</button>-->
                                        <a href="{{ route('cars.show', $car) }}" class="btn rent-btn">Rent now</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>

        <!-- Get Start Section -->
        <section class="section get-start">
            <div class="container">
                <h2 class="h2 section-title">Get started with 4 simple steps</h2>
                <ul class="get-start-list">
                    <li>
                        <div class="get-start-card">
                            <div class="card-icon icon-1">
                                <ion-icon name="person-add-outline"></ion-icon>
                            </div>
                            <h3 class="card-title">Create a profile</h3>
                            <p class="card-text">If you are going to use a passage of Lorem Ipsum, you need to be sure.</p>
                            <a href="#" class="card-link">Get started</a>
                        </div>
                    </li>
                    <li>
                        <div class="get-start-card">
                            <div class="card-icon icon-2">
                                <ion-icon name="car-outline"></ion-icon>
                            </div>
                            <h3 class="card-title">Tell us what car you want</h3>
                            <p class="card-text">Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>
                        </div>
                    </li>
                    <li>
                        <div class="get-start-card">
                            <div class="card-icon icon-3">
                                <i class="fa-regular fa-circle-check"></i>
                            </div>
                            <h3 class="card-title">Check availability</h3>
                            <p class="card-text">It to make a type specimen book. It has survived not only five centuries, but also the leap into electronic</p>
                        </div>
                    </li>
                    <li>
                        <div class="get-start-card">
                            <div class="card-icon icon-4">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <h3 class="card-title">Make a deal</h3>
                            <p class="card-text">There are many variations of passages of Lorem available, but the majority have suffered alteration</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </article>
@endsection
