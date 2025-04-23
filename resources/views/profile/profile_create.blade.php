@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Profil</h2>
    <form action="{{ route('profile.store') }}" method="POST">
        @csrf

        <div>
            <label>Umur:</label>
            <input type="number" name="age" required>
        </div>

        <div>
            <label>Tinggi (cm):</label>
            <input type="number" name="height" required>
        </div>

        <div>
            <label>Berat (kg):</label>
            <input type="number" name="weight" required>
        </div>

        <div>
            <label>Jenis Kelamin:</label>
            <select name="gender" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div>
            <label>Level Aktivitas (opsional):</label>
            <input type="text" name="activity_level">
        </div>

        <div>
            <label>Preferensi Diet (opsional):</label>
            <input type="text" name="diet_preferences">
        </div>

        <button type="submit">Simpan</button>
    </form>
</div>
@endsection
