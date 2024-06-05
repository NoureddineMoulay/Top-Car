<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'make',
        'model',
        'year',
        'rental_price_per_day',
        'status',
        'location',
        'description',// 'available', 'rented', 'maintenance'
        'number_of_seats', // number of seats
        'transmission', // 'automatic' or 'manual'
        'fuel_type', // 'gazoil', 'petrol', 'electric', etc.
        'consumption', // fuel consumption, e.g., liters per 100km
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function car_images()
    {
        return $this->hasMany(CarImage::class);
    }
    public function first_image()
    {
        return $this->car_images->first();
    }

    public function second_image()
    {
        return $this->car_images->get(1); // Index 1 represents the second image
    }

    /**
     * Get the third image associated with the car.
     */
    public function third_image()
    {
        return $this->car_images->get(2); // Index 2 represents the third image
    }

    /**
     * Get the fourth image associated with the car.
     */
    public function fourth_image()
    {
        return $this->car_images->get(3); // Index 3 represents the fourth image
    }
}


