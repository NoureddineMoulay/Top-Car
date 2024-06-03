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

                <div class="description">
                    <h2>Description</h2>
                    <p style="color: var(--grey);">
                        {{ $car->description }}
                    </p>
                </div>
                <div class="customer-reviews">
                    <h2>Customer Reviews</h2>
                    @if ($car->reviews->count() > 0)
                        @foreach ($car->reviews as $review)
                            <div class="review-section">
                                <div class="customer-details">
                                    <div class="customer-pic">
                                        <img src="{{ asset('images/user.png') }}" alt="User Avatar" style="height: 40px; width: 40px;">
                                    </div>
                                    <div class="username-stars">
                                        <p>{{ $review->user->name }}</p>
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <span><i class="fa-solid fa-star"></i></span>
                                        @endfor
                                    </div>
                                </div>
                                <div class="review-content">
                                    {{ $review->comment }}
                                </div>
                                @if (auth()->id() === $review->user_id)
                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete Review</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <p>No reviews yet.</p>
                    @endif

                    <button class="see-allBtn">See all</button>

                    <!-- Review Form -->
                    <div class="review-submit">
                        <h2>Leave a Review</h2>
                        <form action="{{ route('cars.reviews.store', $car) }}" method="POST" class="review-form">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <textarea placeholder="Enter your review..." name="comment" required></textarea>
                            <div class="review-stars">
                                <label>Rating (1-5):</label>
                                <input type="number" min="1" max="5" name="rating" required>
                            </div>
                            <button type="submit">Submit Review</button>
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
