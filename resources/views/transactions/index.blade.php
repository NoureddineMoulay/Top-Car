@extends('layouts.dash')
@section('title', 'Dashboard | Admin')
@section('content')
    <div class="filter-buttons">
        <div class="title">
            <h2>Transactions</h2>
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
            <th>Transaction ID</th>
            <th>User</th>
            <th>Booking ID</th>
            <th>Amount</th>
            <th>Payment Date</th>
            <th>Payment Method</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->id }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->booking_id }}</td>
                <td>{{ $transaction->amount }}</td>
                <td>{{ $transaction->payment_date }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->status }}</td>
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
            // doc.text('Transaction List', 10, 10);
            // doc.autoTable({html: '.table'});
            // doc.save('transaction_list.pdf');
        });
    </script>
@endsection
