<p>Dear {{ $booking->user->name }},</p>
<p>Your booking for the car {{ $booking->car->model }} has been made successfully.</p>
<p>booking Details:</p>
<ul>
    <li>Start Date: {{ $booking->start_date }}</li>
    <li>End Date: {{ $booking->end_date }}</li>
    <li>Total Price: {{ $booking->total_price }}</li>
</ul>
<p>Thank you for choosing our service!</p>
