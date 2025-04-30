<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <h2>Edit Profil</h2>
    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Usia</label>
                    <input type="number" name="age" value="{{ old('age', $profile->age) }}" class="form-control" required min="1" max="120">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-control" required>
                        <option value="Perempuan" {{ $profile->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        <option value="Laki-laki" {{ $profile->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Lainnya" {{ $profile->gender == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tinggi (cm)</label>
                    <input type="number" name="height" value="{{ old('height', $profile->height) }}" class="form-control" required min="50" max="250">
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" step="0.1" name="weight" value="{{ old('weight', $profile->weight) }}" class="form-control" required min="20" max="300">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tingkat Aktivitas</label>
            <select name="activity_level" class="form-control" required>
                <option value="Sangat Aktif" {{ $profile->activity_level == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                <option value="Cukup Aktif" {{ $profile->activity_level == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                <option value="Kurang Aktif" {{ $profile->activity_level == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Preferensi Diet</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="vegetarian" value="Vegetarian" {{ in_array('Vegetarian', $profile->diet_preferences) ? 'checked' : '' }}>
                <label class="form-check-label" for="vegetarian">Vegetarian</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="low_calorie" value="Rendah Kalori" {{ in_array('Rendah Kalori', $profile->diet_preferences) ? 'checked' : '' }}>
                <label class="form-check-label" for="low_calorie">Rendah Kalori</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="gluten_free" value="Bebas gluten" {{ in_array('Bebas gluten', $profile->diet_preferences) ? 'checked' : '' }}>
                <label class="form-check-label" for="gluten_free">Bebas gluten</label>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>