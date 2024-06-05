@extends('layouts.carh')

@section('content')
    <div class="container-success">
        <div class="content">
            <i class="fas fa-check-circle"></i>
            <h1>Payment Successful</h1>
            <p>Thank you for your reservation!</p>
            <p>Your booking is confirmed. An invoice has been sent to your email.</p>
            <a href="{{ $pdfPath }}" id="download-link" download="invoice.pdf" class="download-btn">Download Invoice</a>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Automatically trigger the download
        document.getElementById('download-link').click();
    </script>
@endsection
