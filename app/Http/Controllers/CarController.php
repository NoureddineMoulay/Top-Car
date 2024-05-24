<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('cars.index');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        \Log::info('Store Car Request: ', $request->all());

        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'rental_price_per_day' => 'required|numeric',
            'status' => 'required|in:available,rented,maintenance',
            'number_of_seats' => 'required|integer',
            'transmission' => 'required|in:automatic,manual',
            'fuel_type' => 'required|in:gazoil,petrol,electric,hybrid',
            'consumption' => 'required|numeric',
            'car_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        \Log::info('Validation passed.');

        if ($request->hasFile('car_image')) {
            \Log::info('File is present.');
            $imagePath = $request->file('car_image')->store('car_images','public');
            \Log::info('Image Path: ' . $imagePath);

            $data = $request->all();
            $data['car_image'] = $imagePath;

            $car = Car::create($data);
            \Log::info('Car created with ID: ' . $car->id);
        } else {
            \Log::info('File is not present.');
        }

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }


    // Display the specified resource
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    // Show the form for editing the specified resource
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rental_price_per_day' => 'required|numeric',
            'number_of_seats' => 'required|integer',
            'status' => 'required|string',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'consumption' => 'required|numeric',
        ]);

        if ($request->hasFile('car_image')) {
            $imagePath = $request->file('car_image')->store('car_images', 'public');
            $car->car_image = $imagePath;
        }

        $car->make = $request->make;
        $car->model = $request->model;
        $car->year = $request->year;
        $car->rental_price_per_day = $request->rental_price_per_day;
        $car->number_of_seats = $request->number_of_seats;
        $car->status = $request->status;
        $car->fuel_type = $request->fuel_type;
        $car->transmission = $request->transmission;
        $car->consumption = $request->consumption;

        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }
    // Remove the specified resource from storage
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
}
?>
