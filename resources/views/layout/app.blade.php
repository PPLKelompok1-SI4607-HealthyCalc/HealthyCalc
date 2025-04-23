<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>HealthyCalc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <img src="https://img.icons8.com/ios-filled/50/4CAF50/calculator.png" alt="Logo" class="h-6 w-6">
            <span class="font-bold text-xl text-green-600">HealthyCalc</span>
        </div>
        <div class="flex items-center gap-3">
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/32' }}" class="h-8 w-8 rounded-full object-cover" alt="User">
        </div>
    </nav>

    <!-- Main content -->
    <main class="p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-sm text-gray-500 py-6 mt-10 border-t">
        © 2025 HealthyCalc. All rights reserved.
    </footer>

</body>
</html>
