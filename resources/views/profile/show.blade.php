<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-section {
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .profile-title {
            color: #2c3e50;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h1 class="profile-title">Pengaturan Profil</h1>
    <p class="mb-4">Kelola informasi pribadi dan preferensi kesehatan Anda</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="profile-section">
                <h3>Ubah Data</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Lengkap</strong><br>{{ $profile->name }}</p>
                        <p><strong>Usia</strong><br>{{ $profile->age }}</p>
                        <p><strong>Tinggi (cm)</strong><br>{{ $profile->height }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email</strong><br>{{ $profile->email }}</p>
                        <p><strong>Jenis Kelamin</strong><br>{{ $profile->gender }}</p>
                        <p><strong>Berat (kg)</strong><br>{{ $profile->weight }}</p>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h3>Tingkat Aktivitas</h3>
                <p>{{ $profile->activity_level }}</p>
            </div>

            <div class="profile-section">
                <h3>Preferensi Diet</h3>
                <ul>
                    @foreach($profile->diet_preferences as $preference)
                        <li>{{ $preference }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-4">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
                <form action="{{ route('profile.destroy') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus profil?')">Hapus Profil</button>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-center text-muted">
        <p>© 2028 HealthyClac. All rights reserved.</p>
    </footer>
</div>
</body>
</html>