<?php

namespace App\Http\Controllers;

use App\Mail\BookingMade;
use App\Models\Car;
use App\Models\User;
use App\Models\Booking;
use App\Notifications\ReservationCanceled;
use App\Notifications\ReservationMade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    public function list()
    {
        $bookings = Booking::with(['user', 'car'])->get();
        return view('bookings.list', compact('bookings'));
    }
    public function index()
    {
        $bookings = Booking::with('car')->where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }


    public function show($id)
    {
        $booking = Booking::with('car')->findOrFail($id);
        return view('bookings.show', compact('booking'));
    }



public function cancel(Request $request, Booking $booking)
{
    $user = Auth::user();
    // Ensure the user owns the booking
    if ($booking->user_id !== Auth::id()) {
        return redirect()->route('bookings.index')->with('error', 'Unauthorized action.');
    }

    // Check if the booking is pending (not paid yet)
    if ($booking->status !== 'pending') {
        return redirect()->route('bookings.index')->with('error', 'You cannot cancel a paid booking.');
    }

    // Update the booking status
    $booking->status = 'cancelled';
    $booking->save();

    // Send notification to the user
    $user->notify(new ReservationCanceled($booking));

    return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully.');
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
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);
        $user = Auth::user();

        if (!$user) {
            // Handle the case when the user is not authenticated
            return redirect()->route('login')->with('error', 'You need to be logged in to make a reservation.');
        }
        $car = Car::findOrFail($request->car_id);
        $rentalPerDay = $car->rental_price_per_day;

        // Convert dates to Carbon instances
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        // Calculate the difference in days
        $diffDays = $startDate->diffInDays($endDate);

        // Calculate total price
        $totalPrice = $rentalPerDay * $diffDays;

        // Debugging statements
        \Log::info('Rental Per Day: ' . $rentalPerDay);
        \Log::info('Start Date: ' . $startDate);
        \Log::info('End Date: ' . $endDate);
        \Log::info('Difference in Days: ' . $diffDays);
        \Log::info('Total Price: ' . $totalPrice);

        // Save the booking
        $booking = new Booking();
        $booking->car_id = $request->car_id;
        $booking->user_id = Auth::id();
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->total_price = $totalPrice;
        $booking->save();
        $user->notify(new ReservationMade($booking));
        // Redirect to the payment page (you need to define the payment route and page)
        return redirect()->route('bookings.index');    }
}

