<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .form-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-control {
            background: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            padding: 10px;
            border-radius: 5px;
        }

        .form-control::placeholder {
            color: #999;
        }

        .form-control:focus {
            background: white;
            border-color: #2babe7;
            box-shadow: none;
        }

        .btn-custom {
            width: 100%;
            background: #2babe7;
            border: none;
            font-weight: bold;
            padding: 10px;
            color: white;
            transition: background 0.3s ease;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background: #2387b6;
        }

        .home-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #007bff;
            color: white;
            padding: 5px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
        }

        .register-link {
            margin-top: 1rem;
            display: block;
            color: #2babe7;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link:hover {
            color: #2387b6;
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 1.5rem;
            border-radius: 5px;
        }

        .alert-danger {
            background: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .alert-success {
            background: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <a href="/" class="home-btn"><i class="fas fa-home"></i> Home</a>
        <h2 class="form-title">Login</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email"
                    value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" class="form-control" required
                        placeholder="Enter your password">
                    <button type="button" id="togglePassword" class="password-toggle-btn">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-custom">Login</button>
        </form>
        <a href="{{ route('register') }}" class="register-link">Not registered yet? Create an account</a>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const eyeIcon = this.querySelector('i');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>