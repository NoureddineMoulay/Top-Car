@extends('layouts.dash')
@section('title', 'Dashboard | Admin')
@section('content')
            <div class="filter-buttons">
                <div class="title">
                    <h2>Cars</h2>
                </div>
                <div class="btn">
                    <input type="search" placeholder="Search..">
                    <button id="openModalButton" class="download-button">
                        <i class="fa-solid fa-plus"></i> Add a new Car
                    </button>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>

                    <th>Car ID</th>
                    <th>Image</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Price for Rental</th>
                    <th>Status</th>
                    <th>Number of Seats</th>
                    <TH>Location</TH>
                    <th>Fuel</th>
                    <th>Transmission</th>
                    <th>Consumption</th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td style="font-weight: 900;">{{ $car->id }}</td>
                        <td>
                            @if($car->first_image())
                                <img src="{{ asset($car->first_image()->image_path) }}" alt="{{ $car->make }} {{ $car->model }}" style="border-radius: 50%; height: 50px; width: 50px; object-fit: cover;">
                            @else
                                No image
                            @endif
                        </td>
                        <td>{{ $car->make }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->rental_price_per_day }}</td>
                        <td>{{ $car->status }}</td>
                        <td>{{ $car->number_of_seats }}</td>
                        <td>{{$car->location}}</td>
                        <td>{{ $car->fuel_type }}</td>
                        <td>{{ $car->transmission }}</td>
                        <td>{{ $car->consumption }}</td>
                        <td>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btnsEd"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                            <button class="edit-button btnsEd" data-id="{{ $car->id }}" data-make="{{ $car->make }}" data-model="{{ $car->model }}" data-year="{{ $car->year }}" data-price="{{ $car->rental_price_per_day }}" data-status="{{ $car->status }}" data-seats="{{ $car->number_of_seats }}" data-fuel="{{ $car->fuel_type }}" data-transmission="{{ $car->transmission }}" data-consumption="{{ $car->consumption }}" data-image="{{ $car->car_image }}"><i class="fa-solid fa-pen-to-square"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endsection

<!-- Modal -->
<div id="addCarModal" class="modal">

    <div class="modal-content">
        <span class="close" id="close-icon" onclick="hide()"><i class="fa-solid fa-circle-xmark"></i></span>

        <h2>Add a New Car</h2>
        <form action="{{ route('cars.store') }}" method="POST" id="addCarForm" class="form-body" enctype="multipart/form-data">
            @csrf
            <div class="input-box">
                <span><i class="fa-solid fa-car"></i></span>
                <input type="text" id="make" name="make" placeholder="Make" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-car"></i></span>
                <input type="text" id="model" name="model" placeholder="Model" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-calendar"></i></span>
                <input type="number" id="year" name="year" placeholder="Year" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-location"></i></span>
                <input type="text" id="location" name="location" placeholder="location" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-location"></i></span>
                <input type="text" id="description" name="description" placeholder="description" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-image"></i></span>
                <input type="file" id="car_image" name="car_images[]" multiple>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-dollar-sign"></i></span>
                <input type="number" id="rental_price_per_day" name="rental_price_per_day" placeholder="Rental Price per Day" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-seat"></i></span>
                <input type="number" id="number_of_seats" name="number_of_seats" placeholder="Number of Seats" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-info-circle"></i></span>
                <select id="status" name="status" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="available">Available</option>
                    <option value="rented">Rented</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>

            <div class="input-box">
                <span><i class="fa-solid fa-gas-pump"></i></span>
                <select id="fuel_type" name="fuel_type" required>
                    <option value="" disabled selected>Select Fuel Type</option>
                    <option value="gazoil">Gazoil</option>
                    <option value="petrol">Petrol</option>
                    <option value="electric">Electric</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-gear"></i></span>
                <select id="transmission" name="transmission" required>
                    <option value="" disabled selected>Select Transmission</option>
                    <option value="automatic">Automatic</option>
                    <option value="manual">Manual</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-gas-pump"></i></span>
                <input type="number" id="consumption" name="consumption" placeholder="Consumption" required>
            </div>
            <button type="submit" class="btn">Add Car</button>
        </form>
    </div>
</div>

<!-- Edit Car Modal -->
<div id="editCarModal" class="modal">
    <div class="modal-content">
        <span class="close" id="editCloseIcon" onclick="hideEditModal()"><i class="fa-solid fa-circle-xmark"></i></span>
        <h2>Edit Car</h2>
        <form action="" method="POST" id="editCarForm" class="form-body" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editCarId" name="id">
            <div class="input-box">
                <span><i class="fa-solid fa-car"></i></span>
                <input type="text" id="editMake" name="make" placeholder="Make" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-car"></i></span>
                <input type="text" id="editModel" name="model" placeholder="Model" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-calendar"></i></span>
                <input type="number" id="editYear" name="year" placeholder="Year" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-image"></i></span>
                <input type="file" id="editCarImage" name="car_images[]" multiple>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-dollar-sign"></i></span>
                <input type="number" id="editRentalPricePerDay" name="rental_price_per_day" placeholder="Rental Price per Day" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-seat"></i></span>
                <input type="number" id="editNumberOfSeats" name="number_of_seats" placeholder="Number of Seats" required>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-info-circle"></i></span>
                <select id="editStatus" name="status" required>
                    <option value="" disabled>Select Status</option>
                    <option value="available">Available</option>
                    <option value="rented">Rented</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-gas-pump"></i></span>
                <select id="editFuelType" name="fuel_type" required>
                    <option value="" disabled>Select Fuel Type</option>
                    <option value="gazoil">Gazoil</option>
                    <option value="petrol">Petrol</option>
                    <option value="electric">Electric</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-gear"></i></span>
                <select id="editTransmission" name="transmission" required>
                    <option value="" disabled>Select Transmission</option>
                    <option value="automatic">Automatic</option>
                    <option value="manual">Manual</option>
                </select>
            </div>
            <div class="input-box">
                <span><i class="fa-solid fa-gas-pump"></i></span>
                <input type="number" id="editConsumption" name="consumption" placeholder="Consumption" required>
            </div>
            <button type="submit" class="btn">Update Car</button>
        </form>
    </div>
</div>



<!-- JavaScript to handle modal -->
<!-- JavaScript to handle modal -->
<script>
   /* document.addEventListener("DOMContentLoaded", function() {
        // Get the modal
        var modal = document.getElementById('addCarModal');

        // Get the button that opens the modal
        var btn = document.getElementById("openModalButton");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }); */



    // modal

    document.addEventListener("DOMContentLoaded", function() {
        // Get the modals
        var addCarModal = document.getElementById('addCarModal');
        var editCarModal = document.getElementById('editCarModal');

        // Get the buttons that open the modals
        var addCarBtn = document.getElementById("openModalButton");

        // Get the close icons
        var addCarCloseIcon = document.getElementById("close-icon");
        var editCarCloseIcon = document.getElementById("editCloseIcon");

        // When the user clicks the button, open the add car modal
        addCarBtn.onclick = function() {
            addCarModal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the add car modal
        addCarCloseIcon.onclick = function() {
            addCarModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === addCarModal) {
                addCarModal.style.display = "none";
            }
        }

        // Handle edit button click
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                var carId = this.getAttribute('data-id');
                var carMake = this.getAttribute('data-make');
                var carModel = this.getAttribute('data-model');
                var carYear = this.getAttribute('data-year');
                var carPrice = this.getAttribute('data-price');
                var carStatus = this.getAttribute('data-status');
                var carSeats = this.getAttribute('data-seats');
                var carFuel = this.getAttribute('data-fuel');
                var carTransmission = this.getAttribute('data-transmission');
                var carConsumption = this.getAttribute('data-consumption');
                var carImage = this.getAttribute('data-image');

                // Populate the form with the car details
                document.getElementById('editCarId').value = carId;
                document.getElementById('editMake').value = carMake;
                document.getElementById('editModel').value = carModel;
                document.getElementById('editYear').value = carYear;
                document.getElementById('editRentalPricePerDay').value = carPrice;
                document.getElementById('editStatus').value = carStatus;
                document.getElementById('editNumberOfSeats').value = carSeats;
                document.getElementById('editFuelType').value = carFuel;
                document.getElementById('editTransmission').value = carTransmission;
                document.getElementById('editConsumption').value = carConsumption;

                // Set the form action to the update route
                document.getElementById('editCarForm').action = '/cars/' + carId;

                // Display the modal
                editCarModal.style.display = "block";
            });
        });

        // When the user clicks on <span> (x), close the edit car modal
        editCarCloseIcon.onclick = function() {
            editCarModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target === editCarModal) {
                editCarModal.style.display = "none";
            }
        }
    });

    function hideEditModal() {
        document.getElementById('editCarModal').style.display = 'none';
    }

</script>


<!-- Styles for the modal -->

