<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmed</title>
</head>
<body>
<h1>Reservation Confirmed</h1>
<p>Dear {{ $booking->user->name }},</p>
<p>Your booking for the car {{ $booking->car->model }} has been made successfully.</p>
<p>Booking Details:</p>
<ul>
    <li>Start Date: {{ $booking->start_date }}</li>
    <li>End Date: {{ $booking->end_date }}</li>
    <li>Total Price: ${{ $booking->total_price }}</li>
</ul>
<p>Thank you for choosing our service!</p>
</body>
</html>
