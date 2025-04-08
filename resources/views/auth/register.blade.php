<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }

        input {
            width: 400px;
            padding: 12px;
            margin: 10px;
            border-radius: 10px;
            border: 1px solid #2b2b2b;
            font-size: 16px;
        }

        .btn {
            padding: 12px;
            border-radius: 25px;
            width: 420px;
            margin: 10px auto;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        .btn-primary {
            background-color: #009966;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #007f55;
        }

        .btn-primary:active {
            transform: scale(0.98);
        }

        .btn-outline {
            background-color: white;
            border: 1px solid #2b2b2b;
            color: #2b2b2b;
        }

        .btn-outline:hover {
            background-color: #f2f2f2;
        }

        .btn-outline:active {
            transform: scale(0.98);
        }

        .divider {
            margin: 20px auto;
            width: 420px;
            display: flex;
            align-items: center;
            color: gray;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #ccc;
        }

        .divider span {
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <h1>Sign Up</h1>
    <p>Create an account</p>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf
        <input type="text" name="name" placeholder="Enter your name" value="{{ old('name') }}"><br>
        <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}"><br>
        <input type="password" name="password" placeholder="Enter your password"><br>
        <button class="btn btn-primary" type="submit">Sign Up</button>
    </form>

    <div class="divider"><span>or</span></div>

    <a href="{{ route('login') }}">
        <button class="btn btn-outline">Sign In</button>
    </a>
</body>
</html>
