<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <style>
        /* Add your custom styles here */
        body {
            font-family: "Figtree",sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
        }
        .logo {
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="./images/logo.png" alt="Top Car" class="logo">
    <div class="message">
        <p>Dear {{ $booking->user->name }},</p>
        <p>Your booking for the car {{ $booking->car->model }} has been made successfully.</p>
        <p>Thank you for choosing our service!</p>
    </div>
</div>
</body>
</html>
