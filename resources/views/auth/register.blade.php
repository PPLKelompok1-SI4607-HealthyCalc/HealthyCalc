@extends('layouts.tailwind-app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center mb-4">Register</h2>

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <!-- Nama Lengkap -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('email') }}" required>
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" name="username" id="username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('username') }}" required>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Daftar</button>
    </form>
</div>
@endsection
