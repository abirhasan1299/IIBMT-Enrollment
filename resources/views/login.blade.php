<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #004e92, #000428);
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .login-card h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #fff;
        }

        .form-control {
            border-radius: 10px;
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
            border: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.25);
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.35);
            color: #fff;
        }

        .btn-login {
            border-radius: 10px;
            background: linear-gradient(45deg, #007bff, #00d4ff);
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 212, 255, 0.4);
        }

        .extra-text {
            margin-top: 1rem;
            font-size: 0.9rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.85);
        }

        .extra-text a {
            color: #00d4ff;
            font-weight: 600;
            text-decoration: none;
        }

        .extra-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="login-card">
    @if (session('invalid'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('invalid') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <h5>Welcome Back 👋</h5>

    <form method="post" action="{{ route('adminVerify') }}" autocomplete="off">
        @csrf
        <div class="mb-3">
            <input type="email" name="email" placeholder="Email Address" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <a href="#" class="text-light small">Forgot Password?</a>
        </div>

        <button type="submit" class="btn btn-login w-100">Login</button>

        <div class="extra-text">
            Don't have an account? <a href="#">Contact with Institute</a>
        </div>
    </form>
</div>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
