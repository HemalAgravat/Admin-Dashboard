<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('css1/style.css') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>

    <div class="wrapper">
        <div class="logo">
            <img src="{{ URL('image/admin.jpg') }}" alt="">
        </div>
        <div class="text-center mt-4 name">
            LOGIN
        </div>
        <form class="p-3 mt-3" action="{{ route('login') }}" method="post" id="loginForm">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
                <span id="emailError" class="invalid-feedback" role="alert"></span>
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
                <span id="passwordError" class="invalid-feedback" role="alert"></span>
            </div>
            <button type="submit" class="btn mt-3">Login</button>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                validateForm();
            });

            emailInput.addEventListener('input', function () {
                if (!emailInput.value.trim()) {
                    emailError.textContent = 'Please enter your email';
                } else {
                    emailError.textContent = '';
                }
            });

            passwordInput.addEventListener('input', function () {
                if (!passwordInput.value.trim()) {
                    passwordError.textContent = 'Please enter your password';
                } else {
                    passwordError.textContent = '';
                }
            });

            function validateForm() {
                if (!emailInput.value.trim()) {
                    emailError.textContent = 'Please enter your email';
                    return;
                }

                if (!passwordInput.value.trim()) {
                    passwordError.textContent = 'Please enter your password';
                    return;
                }

                form.submit();
            }
        });
    </script>
</body>

</html>
    