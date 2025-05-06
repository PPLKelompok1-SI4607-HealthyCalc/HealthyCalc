<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthCalc - Manajemen Resep Makanan Sehat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="min-h-screen flex flex-col">

<!-- Navbar -->
<nav class="bg-green-500 text-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                </svg>
                HealthCalc
            </a>
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-sm px-3 py-2 rounded-md hover:bg-green-600">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-sm px-3 py-2 rounded-md hover:bg-green-600">Login</a>
                    <a href="{{ route('register') }}" class="text-sm px-3 py-2 rounded-md hover:bg-green-600">Register</a>
                @endguest
            </div>
        </div>
    </div>
</nav>

{{-- Flash messages menggunakan SweetAlert saja, HTML alert dihapus --}}

@if($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 max-w-7xl mx-auto mt-4" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Main Content -->
<main class="flex-grow container mx-auto px-4 py-6">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white border-t border-gray-200 py-6 mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:justify-between md:items-center">
            <div class="mb-4 md:mb-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-green-500 font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                    </svg>
                    HealthCalc
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm text-gray-600">
                <a href="#" class="hover:underline">Tentang Kami</a>
                <a href="#" class="hover:underline">Kebijakan Privasi</a>
                <a href="#" class="hover:underline">Syarat & Ketentuan</a>
                <a href="#" class="hover:underline">Kontak</a>
            </div>
        </div>
        <div class="mt-6 border-t pt-4 text-sm text-gray-500 text-center md:text-left">
            &copy; 2025 HealthCalc. All rights reserved.
        </div>
    </div>
</footer>

@yield('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 5000,
                showConfirmButton: true
            });
        @endif
    });
</script>

</body>
</html>
