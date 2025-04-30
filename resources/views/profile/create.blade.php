<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Lengkapi Profil Anda</h2>
    <form action="{{ route('profile.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="number" name="age" class="form-control" required min="1" max="120">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-control" required>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tinggi (cm)</label>
                    <input type="number" name="height" class="form-control" required min="50" max="250">
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" step="0.1" name="weight" class="form-control" required min="20" max="300">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tingkat Aktivitas</label>
            <select name="activity_level" class="form-control" required>
                <option value="Sangat Aktif">Sangat Aktif</option>
                <option value="Cukup Aktif">Cukup Aktif</option>
                <option value="Kurang Aktif">Kurang Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Preferensi Diet (Pilih yang sesuai)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" value="Vegetarian">
                <label class="form-check-label">Vegetarian</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" value="Rendah Kalori">
                <label class="form-check-label">Rendah Kalori</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" value="Bebas gluten">
                <label class="form-check-label">Bebas gluten</label>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Profil</button>
        </div>
    </form>
</div>
</body>
</html>