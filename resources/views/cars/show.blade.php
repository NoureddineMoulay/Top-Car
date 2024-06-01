@extends('layouts.carh')
@section('title')
    Car Details
@endsection
@section('content')
    <div class="container-show">
        <h2><a href="#">Our Cars</a></h2>
        <section class="section-car">
            <div class="car-details-container">
                <div class="main-car">
                    <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->name }}">
                </div>
                <div class="thumbnail-images">
                    <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->name }}">
                    <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->name }}">
                    <img src="{{ asset('storage/' . $car->car_image) }}" alt="{{ $car->name }}">
                    <!-- Add more thumbnails if available -->
                </div>
            </div>
        </section>
        <div class="name-location">
            <h2>{{ $car->name }}</h2>
            <p style="font-weight: 700;"><i class="fa-solid fa-star start-icon"></i></p>
            <p style="margin-top: 20px;font-size: 20px;font-weight: 700;">
                <i style="margin-right: 10px;" class="fa-solid fa-location-dot"></i>{{ $car->location }}
            </p>
        </div>
        <div class="details-reserveBtn">
            <div class="details">
                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-chair"></i></span>
                    <div class="details-text">
                        Seats
                        <p>{{ $car->seats }} Seats</p>
                    </div>
                </div>

                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-gas-pump"></i></span>
                    <div class="details-text">
                        Fuel Type
                        <p>{{ $car->fuel_type }}</p>
                    </div>
                </div>

                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-tachometer-alt"></i></span>
                    <div class="details-text">
                        Consumption
                        <p>{{ $car->consumption }} km / 1-litre</p>
                    </div>
                </div>

                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-cogs"></i></span>
                    <div class="details-text">
                        Transmission
                        <p>{{ $car->transmission }}</p>
                    </div>
                </div>
                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-cogs"></i></span>
                    <div class="details-text">
                        Brand
                        <p>{{ $car->make }}</p>
                    </div>
                </div>

                <div class="detail-box">
                    <span class="detail-icon"><i class="fa-solid fa-cogs"></i></span>
                    <div class="details-text">
                        Brand
                        <p>{{ $car->make }}</p>
                    </div>
                </div>

                <div class="description">
                    <h2>Description</h2>
                    <p style="color: var(--grey);">
                        {{ $car->description }}
                    </p>
                </div>
                <div class="customer-reviews">
                    <h2>Customer reviews </h2>
                        <div class="review-section">
                            <div class="customer-details">
                                <div class="customer-pic">
                                    <img src="{{ asset('images/user.png') }}" alt="" style="height: 40px; width: 40px;">
                                </div>
                                <div class="username-stars">
                                    <p>test</p>
                                    <span><i class="fa-solid fa-star"></i></span>
                                </div>
                            </div>
                            <div class="review-content">
                               jfhjkdhfdhfefw
                            </div>
                        </div>

                    <button class="see-allBtn">See all</button>
                    <div class="review-submit">
                        <h2>Review</h2>
                        <form class="review-form">
                            <input type="text" placeholder="Your name" name="name">
                            <input type="email" placeholder="Your email" name="email">
                            <textarea placeholder="Enter description..." name="description"></textarea>
                            <div class="review-stars">
                                <label>Review:</label>
                                <input type="number" min="1" max="5" name="rating">
                            </div>
                            <button type="submit">Send review</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="reserve-btn">
                <div class="btn-tite">
                    <div class="price">Price :</div>
                    <span>${{ $car->rental_price_per_day }}</span>
                </div>
                <div class="cont-btn">
                    <a href="{{ route('bookings.create', $car) }}" class="reserve">Reserve Now</a>
                </div>
            </div>
        </div>
        <div class="similar-cars-section">
            <h2 style="font-weight: 700; font-size: 27px;color: var(--grey-text);">Similar cars</h2>
            <div class="similar-cars">
                @foreach($similarCars as $similarCar)
                    <div class="car-card">
                        <img src="{{ asset('storage/' . $similarCar->car_image) }}" alt="{{ $similarCar->name }}">
                        <div class="car-info">
                            <h3>{{ $similarCar->name }}</h3>
                            <div class="car-rating">
                                <span>{{ $similarCar->rating }}</span>
                                <span>{{ $similarCar->reviews_count }} Reviews</span>
                            </div>
                            <div class="car-price">
                                <span>${{ $similarCar->rental_price_per_day }}/day</span>
                                <a href="{{ route('cars.show', $similarCar) }}" class="btn rent-btn">See more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
