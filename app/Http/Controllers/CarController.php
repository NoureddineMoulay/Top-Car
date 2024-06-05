<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarController extends Controller
{


    // Display a listing of the resource
    public function home()
    {
        $cars = Car::all();
        return view('pages.index', compact('cars'));
    }
   public function allCars(Request $request){
           $query = Car::query();

           if ($request->filled('seats')) {
               $query->where('number_of_seats', $request->seats);
           }

           if($request->filled('status')){
               $query->where('status', $request->status);

           }

           if ($request->filled('fuel')) {
               $query->where('fuel_type', $request->fuel);
           }

           if ($request->filled('transmission')) {
               $query->where('transmission', $request->transmission);
           }

           if ($request->filled('year')) {
               $query->where('year', $request->year);
           }

           $cars = $query->get();

           return view('cars.allcars', compact('cars'));
    }
    public function index()
    {
        $cars = Car::with('car_images')->get();
        return view('cars.index', compact('cars'));
    }

    public function search(Request $request)
    {  Log::info('Search method called');
        // Retrieve the search parameters
        $brand = $request->input('brand');
        $price = $request->input('price');
        $location = $request->input('location');

        // Query cars based on search parameters
        $query = Car::query();

        if ($brand) {
            $query->where('make', 'like', "%$brand%");
        }

        if ($price) {
            $query->where('rental_price_per_day', '<=', $price);
        }

        if ($location) {
            $query->where('location', 'like', "%$location%");
        }

        $cars = $query->get();

        // Redirect to a view with the search results
        return view('cars.search-results', compact('cars'));
    }
    // Show the form for creating a new resource
    public function create()
    {
        return view('cars.index');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
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
            'car_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create the car
        $car = Car::create([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'rental_price_per_day' => $request->rental_price_per_day,
            'status' => $request->status,
            'number_of_seats' => $request->number_of_seats,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'consumption' => $request->consumption,
            'location'=>$request->location,
            'description'=>$request->description,
        ]);

        // Upload and store images
        if ($request->hasFile('car_images')) {
            foreach ($request->file('car_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/car_images', $imageName);

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => 'storage/car_images/' . $imageName,
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }


    // Display the specified resource
    public function show(Car $car)
    {
        // Get similar cars, this is just an example, adjust the query as needed
        $similarCars = Car::where('location', $car->location)->where('id', '!=', $car->id)->get();

        return view('cars.show', compact('car', 'similarCars'));
    }

    // Show the form for editing the specified resource
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    // Update the specified resource in storage
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'rental_price_per_day' => 'required|numeric',
            'status' => 'required|string',
            'number_of_seats' => 'required|integer',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'consumption' => 'required|numeric',
            'car_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the car details
        $car->update([
            'make' => $request->make,
            'model' => $request->model,
            'year' => $request->year,
            'rental_price_per_day' => $request->rental_price_per_day,
            'status' => $request->status,
            'number_of_seats' => $request->number_of_seats,
            'transmission' => $request->transmission,
            'fuel_type' => $request->fuel_type,
            'consumption' => $request->consumption,
        ]);

        // Upload and store new images
        if ($request->hasFile('car_images')) {
            foreach ($request->file('car_images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/car_images', $imageName);

                CarImage::create([
                    'car_id' => $car->id,
                    'image_path' => 'storage/car_images/' . $imageName,
                ]);
            }
        }

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
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
