<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'car_id',
        'rating', // 1 to 5 stars
        'comment',
        'created_at',
    ];
}
