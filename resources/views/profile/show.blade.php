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
        .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .profile-header {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            padding: 30px 0;
            margin-bottom: 30px;
            border-radius: 10px;
            color: white;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="profile-header text-center">
        @if($profile->profile->profile_photo_path)
            <img src="{{ asset('storage/' . $profile->profile->profile_photo_path) }}" class="profile-photo mb-3" alt="Foto Profil">
        @else
            <div class="profile-photo mb-3 mx-auto bg-light d-flex align-items-center justify-content-center">
                <i class="fas fa-user fa-3x text-muted"></i>
            </div>
        @endif
        <h1 class="profile-title">Pengaturan Profil</h1>
        <p class="mb-0">Kelola informasi pribadi dan preferensi kesehatan Anda</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="profile-section">
                <h3>Data Pribadi</h3>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama Lengkap</strong><br>{{ $profile->name }}</p>
                        <p><strong>Usia</strong><br>{{ $profile->profile->age }} tahun</p>
                        <p><strong>Tinggi Badan</strong><br>{{ $profile->profile->height }} cm</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email</strong><br>{{ $profile->email }}</p>
                        <p><strong>Jenis Kelamin</strong><br>{{ $profile->profile->gender }}</p>
                        <p><strong>Berat Badan</strong><br>{{ $profile->profile->weight }} kg</p>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h3>Tingkat Aktivitas</h3>
                <p>{{ $profile->profile->activity_level }}</p>
            </div>

            <div class="profile-section">
                <h3>Preferensi Diet</h3>
                <ul class="list-unstyled">
                    @if($profile->profile->is_vegetarian)
                        <li><i class="fas fa-leaf text-success me-2"></i> Vegetarian</li>
                    @endif
                    @if($profile->profile->is_low_calorie)
                        <li><i class="fas fa-apple-alt text-primary me-2"></i> Rendah Kalori</li>
                    @endif
                    @if($profile->profile->is_gluten_free)
                        <li><i class="fas fa-bread-slice text-warning me-2"></i> Bebas Gluten</li>
                    @endif
                    @if(!$profile->profile->is_vegetarian && !$profile->profile->is_low_calorie && !$profile->profile->is_gluten_free)
                        <li>Tidak ada preferensi diet khusus</li>
                    @endif
                </ul>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Profil
                </a>
                <form action="{{ route('profile.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus profil?')">
                        <i class="fas fa-trash me-2"></i>Hapus Profil
                    </button>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-5 text-center text-muted">
        <p>© {{ date('Y') }} HealthyCalc. All rights reserved.</p>
    </footer>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>