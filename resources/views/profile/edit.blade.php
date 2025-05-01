<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-photo-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }
        .profile-photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .photo-upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #6e8efb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .photo-upload-btn:hover {
            background: #5a7bf0;
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="text-center mb-4">Edit Profil</h2>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="text-center mb-4">
            <div class="profile-photo-container">
                @if($profile->profile->profile_photo_path)
                    <img src="{{ asset('storage/' . $profile->profile->profile_photo_path) }}" class="profile-photo" id="profilePhotoPreview">
                @else
                    <div class="profile-photo bg-light d-flex align-items-center justify-content-center" id="profilePhotoPreview">
                        <i class="fas fa-user fa-3x text-muted"></i>
                    </div>
                @endif
                <label class="photo-upload-btn" for="profilePhoto">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" name="profile_photo" id="profilePhoto" accept="image/*" class="d-none" onchange="previewImage(this)">
            </div>
        </div>

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
                    <input type="number" name="age" value="{{ old('age', $profile->profile->age) }}" class="form-control" required min="1" max="120">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-control" required>
                        <option value="Perempuan" {{ $profile->profile->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        <option value="Laki-laki" {{ $profile->profile->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Lainnya" {{ $profile->profile->gender == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tinggi Badan (cm)</label>
                    <input type="number" name="height" value="{{ old('height', $profile->profile->height) }}" class="form-control" required min="50" max="250">
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat Badan (kg)</label>
                    <input type="number" step="0.1" name="weight" value="{{ old('weight', $profile->profile->weight) }}" class="form-control" required min="20" max="300">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tingkat Aktivitas</label>
            <select name="activity_level" class="form-control" required>
                <option value="Sangat Aktif" {{ $profile->profile->activity_level == 'Sangat Aktif' ? 'selected' : '' }}>Sangat Aktif</option>
                <option value="Cukup Aktif" {{ $profile->profile->activity_level == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                <option value="Kurang Aktif" {{ $profile->profile->activity_level == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Preferensi Diet</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="vegetarian" value="Vegetarian" {{ $profile->profile->is_vegetarian ? 'checked' : '' }}>
                <label class="form-check-label" for="vegetarian">Vegetarian</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="low_calorie" value="Rendah Kalori" {{ $profile->profile->is_low_calorie ? 'checked' : '' }}>
                <label class="form-check-label" for="low_calorie">Rendah Kalori</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="gluten_free" value="Bebas gluten" {{ $profile->profile->is_gluten_free ? 'checked' : '' }}>
                <label class="form-check-label" for="gluten_free">Bebas Gluten</label>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
            <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Batal
            </a>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('profilePhotoPreview');
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                // If it's the placeholder div, replace with img
                const newImg = document.createElement('img');
                newImg.src = e.target.result;
                newImg.className = 'profile-photo';
                newImg.id = 'profilePhotoPreview';
                preview.parentNode.replaceChild(newImg, preview);
            }
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>