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
</body>
</html>
