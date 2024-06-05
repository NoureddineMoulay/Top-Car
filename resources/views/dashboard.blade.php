@extends('layouts.dash')
@section('title', 'Dashboard | Admin')

@section('content')
    <div class="welcome-message">
        <h2>Welcome Back, {{ auth()->user()->name }}</h2>
    </div>
    <div class="dashboard-summary">
        <div class="summary-box">
            <div class="box-content">
                <span>Total Vehicles</span>
                <h3>{{ $carCount }}</h3>
                <div class="box-icon">
                    <i class="fa-solid fa-car"></i>
                </div>
            </div>
        </div>
        <div class="summary-box">
            <div class="box-content">
                <span>Upcoming Bookings</span>
                <h3>{{ $bookingCount }}</h3>
                <div class="box-icon">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>
        </div>
        <div class="summary-box">
            <div class="box-content">
                <span>New Customers</span>
                <h3>{{ $userCount }}</h3>
                <div class="box-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
        <div class="summary-box">
            <div class="box-content">
                <span>Total Transactions</span>
                <h3>{{ $transactionCount }}</h3>
                <div class="box-icon">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="chart-container">
        <canvas id="dashboardChart"></canvas>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlyBookings = @json($monthlyBookings);
        const monthlyTransactions = @json($monthlyTransactions);

        console.log("Monthly Bookings:", monthlyBookings);
        console.log("Monthly Transactions:", monthlyTransactions);

        const labels = Object.keys(monthlyBookings).map(month => new Date(0, month - 1).toLocaleString('default', { month: 'long' }));
        const bookingData = Object.values(monthlyBookings);
        const transactionData = Object.values(monthlyTransactions);

        console.log("Labels:", labels);
        console.log("Booking Data:", bookingData);
        console.log("Transaction Data:", transactionData);

        const ctx = document.getElementById('dashboardChart').getContext('2d');
        const dashboardChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['No data'],
                datasets: [{
                    label: 'Bookings',
                    data: bookingData.length ? bookingData : [0],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }, {
                    label: 'Transactions',
                    data: transactionData.length ? transactionData : [0],
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
