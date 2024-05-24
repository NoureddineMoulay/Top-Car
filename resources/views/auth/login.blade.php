<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/style_auth.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div id="Login-container" class="Login-container">
                <h2>Login</h2>
                
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="form-body" class="form-body">
                    @csrf
                    <div class="input-box">
                        <span><i class="fa-solid fa-user"></i></span>
                        <input type="email" name="email" id="email-login" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username">
                    </div>
                    @error('email')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <div class="input-box">
                        <span><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" id="password-login" placeholder="Password" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <div class="checkbox-frgt">
                        <label><input type="checkbox" name="remember"> Remember me</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn">Login</button>
                    <div class="sign">
                        <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="image-container"></div>
    </div>
    <script src="https://kit.fontawesome.com/a4038e236b.js" crossorigin="anonymous"></script>
</body>
</html>
