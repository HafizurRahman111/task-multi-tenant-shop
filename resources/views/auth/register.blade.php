<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .form-control {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .btn-custom {
            width: 100%;
            background: #2babe7;
            border: none;
            font-weight: bold;
            padding: 10px;
            color: white;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: #219ed8;
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.3);
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
            cursor: pointer;
        }

        .tooltip-icon {
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="form-box">
        <a href="/" class="home-btn"><i class="fas fa-home"></i> Home</a>
        <h2 class="text-center">Register</h2>

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
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="tenant_email" class="form-label">
                        Tenant Email
                        <i class="fas fa-info-circle text-primary tooltip-icon" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="The admin provided your account or email info after creating the tenant. Use that email to register here.">
                        </i>
                    </label>
                    <input type="email" id="tenant_email" name="tenant_email" class="form-control"
                        placeholder="Enter Tenant Email" required>
                </div>
                <div class="col-md-6">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control"
                        placeholder="Enter Full Name" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email"
                        required>
                </div>
                <div class="col-md-6">
                    <label for="shop_name" class="form-label">Shop Name</label>
                    <input type="text" id="shop_name" name="shop_name" class="form-control"
                        placeholder="Enter Shop Name" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Enter Password" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePassword('password', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" placeholder="Confirm Password" required>
                        <button type="button" class="password-toggle-btn"
                            onclick="togglePassword('password_confirmation', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-custom">Register</button>
                </div>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login here</a>
        </div>
    </div>

    <script>
        // Password Toggle Function
        function togglePassword(fieldId, button) {
            const input = document.getElementById(fieldId);
            const icon = button.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        // Initialize Bootstrap Tooltips
        document.addEventListener("DOMContentLoaded", function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>

</html>