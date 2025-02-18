<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4c7abe, #3f70da);
            color: white;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Figtree', Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        .welcome-container {
            max-width: 600px;
            width: 100%;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.5s ease-in-out;
        }

        .welcome-container h1 {
            font-size: clamp(2.2rem, 8vw, 3rem);
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: -1px;
            animation: slideIn 1s ease-out;
        }

        .welcome-container p {
            font-size: clamp(1rem, 4vw, 1.25rem);
            margin-bottom: 30px;
            opacity: 0.9;
            animation: fadeIn 2s ease-in-out;
        }

        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .btn {
            font-size: clamp(1rem, 4vw, 1.2rem);
            font-weight: 600;
            padding: 12px 40px;
            border: none;
            border-radius: 30px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 250px;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary {
            background: #ff6f61;
        }

        .btn-primary:hover {
            background: #ff4a33;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 111, 97, 0.6);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-3px);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="welcome-container">
        <h1>Welcome to Multi Tenant Shop</h1>
        <p>Discover the application. Click below to get started!</p>
        <div class="btn-group">
            <a href="/login" class="btn btn-secondary">Login</a>
            <a href="/register" class="btn btn-secondary">Register</a>
        </div>
    </div>
</body>

</html>