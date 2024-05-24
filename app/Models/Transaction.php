<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',       // user making the payment
        'booking_id',     // associated rental
        'amount',        // amount paid
        'payment_date',  // date of payment
        'payment_method',// payment method used
        'status',        // payment status (completed, pending, failed)
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rental()
    {
        return $this->belongsTo(Booking::class);
    }
}
