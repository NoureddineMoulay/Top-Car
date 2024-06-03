<?php

namespace App\Http\Controllers;

use App\Mail\BookingMade;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use App\Notifications\ReservationMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }


    public function show($id)
    {
        $booking = Booking::with('car')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }
    public function create(Car $car)
    {
        return view('bookings.create', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'total_price' => 'required|numeric',
            'end_date' => 'required|date|after:start_date',
        ]);
        $user = Auth::user();

        if (!$user) {
            // Handle the case when the user is not authenticated
            return redirect()->route('login')->with('error', 'You need to be logged in to make a reservation.');
        }

        $booking = new Booking();
        $booking->user_id = Auth::id();
        $booking->car_id = $request->car_id;
        $booking->start_date = $request->start_date;
        $booking->end_date = $request->end_date;
        $booking->total_price = $request->total_price;
        $booking->status = 'pending';
        $booking->save();
        Mail::to('moulaynoureddinee@gmail.com')->send(new BookingMade($booking));
        $user->notify(new ReservationMade($booking));
        // Redirect to the payment page (you need to define the payment route and page)
        return redirect()->route('bookings.index');    }
}

