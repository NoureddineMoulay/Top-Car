<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/css/style_auth.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="Register-container">
                <h2>Register</h2>
                <form method="POST" action="{{ route('register') }}" id="form-body" class="form-body">
                    @csrf
                    
                    <!-- Name -->
                    <div class="input-box">
                        <span><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="name" id="name-register" placeholder="Name" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>
                    @error('name')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <!-- Email Address -->
                    <div class="input-box mt-4">
                        <span><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" id="email-register" placeholder="Email" value="{{ old('email') }}" required autocomplete="username">
                    </div>
                    @error('email')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                   
<!-- Phone Number -->
<div class="input-box mt-4">
    <span><i class="fa-solid fa-phone"></i></span>
    <input type="tel" name="phone_number" id="phone_number-register" placeholder="Phone Number" value="{{ old('phone_number') }}" autocomplete="tel">
</div>
@error('phone_number')
    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
@enderror

<!-- Address -->
<div class="input-box mt-4">
    <span><i class="fa-solid fa-map-marker"></i></span>
    <input type="text" name="address" id="address-register" placeholder="Address" value="{{ old('address') }}" autocomplete="address">
</div>
@error('address')
    <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
@enderror
                    <!-- Password -->
                    <div class="input-box mt-4">
                        <span><i class="fa-solid fa-lock"></i></span> 
                        <input type="password" name="password" id="password-register" placeholder="Password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <!-- Confirm Password -->
                    <div class="input-box mt-4">
                        <span><i class="fa-solid fa-check"></i></span> 
                        <input type="password" name="password_confirmation" id="password-confirmation-register" placeholder="Confirm Password" required autocomplete="new-password">
                    </div>
                    @error('password_confirmation')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn">Register</button>
                    <div class="sign">
                        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="image-container"></div>
    </div>
    <script src="https://kit.fontawesome.com/a4038e236b.js" crossorigin="anonymous"></script>
</body>
</html>
