@extends('layouts.dash')
@section('title', 'Dashboard | Admin')

@auth
    @if(auth()->user()->role === 'admin')
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
                    <th>Image</th>
                    <th>Car ID</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Price for Rental</th>
                    <th>Status</th>
                    <th>Number of Seats</th>
                    <th>Fuel</th>
                    <th>Transmission</th>
                    <th>Consumption</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    @endsection
    @else
        <p>You are not authorized to access this page.</p>
    @endif
@endauth

<!-- Modal -->
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
                <span><i class="fa-solid fa-image"></i></span>
                <input type="file" id="car_image" name="car_image" required>
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


<!-- JavaScript to handle modal -->
<!-- JavaScript to handle modal -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
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
    });
</script>


<!-- Styles for the modal -->

