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
        'car_image',
        'rental_price_per_day',
        'status', // 'available', 'rented', 'maintenance'
        'number_of_seats', // number of seats
        'transmission', // 'automatic' or 'manual'
        'fuel_type', // 'gazoil', 'petrol', 'electric', etc.
        'consumption', // fuel consumption, e.g., liters per 100km
    ];
}

