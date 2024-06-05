@extends('layouts.dash')
@section('title', 'Dashboard | Bookings')

@section('content')
    <div class="filter-buttons">
        <div class="title">
            <h2>Bookings</h2>
        </div>
        <div class="btn">
            <button id="generatePdfButton" class="download-button">
                <i class="fa-solid fa-file-pdf"></i> Generate PDF
            </button>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Booking ID</th>
            <th>User</th>
            <th>Car</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->id }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->car->make }} {{ $booking->car->model }}</td>
                <td>{{ $booking->start_date }}</td>
                <td>{{ $booking->end_date }}</td>
                <td>{{ $booking->total_price }}</td>
                <td>{{ $booking->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        // JavaScript to handle PDF generation
        document.getElementById('generatePdfButton').addEventListener('click', function () {
            // Code to generate PDF using JavaScript
            // This could involve using a library like jsPDF or html2pdf
            // For example:
            // var doc = new jsPDF();
            // doc.text('Booking List', 10, 10);
            // doc.autoTable({html: '.table'});
            // doc.save('booking_list.pdf');
        });
    </script>
@endsection
