<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Recipe App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
        }

        .container {
            text-align: center;
            margin-top: 100px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        p {
            color: #555;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
        }

        .login {
            background: #3490dc;
        }

        .register {
            background: #38c172;
        }

        .dashboard {
            background: #9561e2;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🍽 Recipe App</h1>
    <p>Login or Register to manage your recipes</p>

    @auth
        <a href="{{ route('dashboard') }}" class="btn dashboard">
            Go to Dashboard
        </a>
    @else
        <a href="{{ route('login') }}" class="btn login">
            Login
        </a>

        <a href="{{ route('register') }}" class="btn register">
            Register
        </a>
    @endauth
</div>

</body>
</html>
