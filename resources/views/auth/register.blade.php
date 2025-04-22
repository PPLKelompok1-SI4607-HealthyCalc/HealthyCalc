<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-white">
    <div class="w-full max-w-md px-6">
        <h2 class="text-3xl font-bold text-center text-green-600">Sign Up</h2>
        <p class="text-center text-sm text-green-500 mb-6">Create an account</p>

        @if(session('success'))
            <div class="mb-4 text-green-600 text-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 text-red-500 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('signup.process') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Enter your name"
                   value="{{ old('name') }}"
                   class="w-full px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-green-500"/>

            <input type="email" name="email" placeholder="Enter your email"
                   value="{{ old('email') }}"
                   class="w-full px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-green-500"/>

            <input type="password" name="password" placeholder="Enter your password"
                   class="w-full px-4 py-2 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-green-500"/>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-full hover:bg-green-700 transition duration-300">
                Sign Up
            </button>

            <div class="flex items-center justify-center">
                <hr class="w-1/3 border-gray-300" />
                <span class="px-2 text-gray-400 text-sm">or</span>
                <hr class="w-1/3 border-gray-300" />
            </div>

            <button type="button" class="w-full border border-gray-400 py-2 rounded-full text-gray-700 hover:bg-gray-100 transition duration-300">
                Sign Up
            </button>
        </form>
    </div>

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
