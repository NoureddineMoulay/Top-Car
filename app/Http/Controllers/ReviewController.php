<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews for a specific car.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Car $car)
    {
        $reviews = $car->reviews()->with('user')->latest()->get();
        return view('reviews.index', compact('car', 'reviews'));
    }

    /**
     * Show the form for creating a new review.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(Car $car)
    {
        return view('reviews.create', compact('car'));
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Car $car)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();
        $review->car_id = $car->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        return redirect()->route('cars.show', $car)->with('success', 'Review added successfully.');
    }

    /**
     * Remove the specified review from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        $car = $review->car;
        $review->delete();

        return redirect()->route('cars.show', $car)->with('success', 'Review deleted successfully.');
    }
}
