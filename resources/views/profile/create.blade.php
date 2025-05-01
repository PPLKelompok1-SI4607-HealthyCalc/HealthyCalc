<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Profil</title>
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
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="text-center mb-4">Lengkapi Profil Anda</h2>
    
    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="text-center mb-4">
            <div class="profile-photo-container">
                <div class="profile-photo bg-light d-flex align-items-center justify-content-center" id="profilePhotoPreview">
                    <i class="fas fa-user fa-3x text-muted"></i>
                </div>
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
                    <label class="form-label">Tinggi Badan (cm)</label>
                    <input type="number" name="height" class="form-control" required min="50" max="250">
                </div>
                <div class="mb-3">
                    <label class="form-label">Berat Badan (kg)</label>
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

        <div class="mb-4">
            <label class="form-label">Preferensi Diet (Pilih yang sesuai)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="vegetarian" value="Vegetarian">
                <label class="form-check-label" for="vegetarian">Vegetarian</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="low_calorie" value="Rendah Kalori">
                <label class="form-check-label" for="low_calorie">Rendah Kalori</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="diet[]" id="gluten_free" value="Bebas gluten">
                <label class="form-check-label" for="gluten_free">Bebas Gluten</label>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-user-plus me-2"></i>Simpan Profil
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('profilePhotoPreview');
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const newImg = document.createElement('img');
            newImg.src = e.target.result;
            newImg.className = 'profile-photo';
            newImg.id = 'profilePhotoPreview';
            preview.parentNode.replaceChild(newImg, preview);
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