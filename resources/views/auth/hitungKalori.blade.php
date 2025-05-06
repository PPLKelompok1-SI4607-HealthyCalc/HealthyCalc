<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan Kebutuhan Kalori & Nutrisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .card {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        .info-item {
            margin-bottom: 10px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
        .nutrisi-box {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .nutrisi-item {
            text-align: center;
            padding: 15px;
            background-color: #e8f4f8;
            border-radius: 8px;
            flex: 1;
            margin: 0 5px;
        }
        .nutrisi-value {
            font-size: 1.5em;
            font-weight: bold;
            color: #2980b9;
        }
        .nutrisi-label {
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
            margin-right: 10px;
            border: none;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #3498db;
        }
        .btn-edit:hover {
            background-color: #2980b9;
        }
        .btn-reset {
            background-color: #e74c3c;
        }
        .btn-reset:hover {
            background-color: #c0392b;
        }
        .btn-submit {
            background-color: #2ecc71;
        }
        .btn-submit:hover {
            background-color: #27ae60;
        }
        .form-group {
            margin-bottom: 15px;
        }
        input, select {
            padding: 8px;
            width: 100%;
            max-width: 300px;
        }
        .current-value {
            font-size: 0.9em;
            color: #666;
            margin-top: 3px;
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .success-message {
            color: green;
            margin-bottom: 15px;
        }
        /* Radio button styling */
        .radio-group {
            display: flex;
            align-items: center;
            margin-top: 8px;
        }
        .radio-option {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .radio-option label {
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Perhitungan Kebutuhan Kalori & Nutrisi</h1>
        
        @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if($mode === 'form')
            <!-- Form Input Data -->
            <form action="{{ route('kalori.hitung') }}" method="POST">
                @csrf
                
                <div class="card">
                    <div class="card-title">Data Pribadi</div>
                    
                    <div class="form-group">
                        <label for="usia">Usia (tahun):</label>
                        <input type="number" id="usia" name="usia" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="laki" name="jenis_kelamin" value="laki" required>
                                <label for="laki">Laki-laki</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan">
                                <label for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan (kg):</label>
                        <input type="number" step="0.1" id="berat_badan" name="berat_badan" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan (cm):</label>
                        <input type="number" id="tinggi_badan" name="tinggi_badan" required>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Aktivitas & Tujuan</div>
                    
                    <div class="form-group">
                        <label for="tingkat_aktivitas">Tingkat Aktivitas:</label>
                        <select id="tingkat_aktivitas" name="tingkat_aktivitas" required>
                            <option value="rendah">Rendah </option>
                            <option value="sedang">Sedang </option>
                            <option value="tinggi">Tinggi </option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="tujuan">Tujuan:</label>
                        <select id="tujuan" name="tujuan" required>
                            <option value="turun">Menurunkan berat badan</option>
                            <option value="jaga">Mempertahankan berat badan</option>
                            <option value="naik">Menambah berat badan</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">Hitung Kebutuhan Kalori</button>
            </form>

        @elseif($mode === 'edit')
            <!-- Form Edit Data -->
            <form action="{{ route('kalori.hitung') }}" method="POST">
                @csrf
                
                <div class="card">
                    <div class="card-title">Data Pribadi</div>
                    
                    <div class="form-group">
                        <label for="usia">Usia (tahun):</label>
                        <input type="number" id="usia" name="usia" value="{{ $data['usia'] }}" required>
                        <div class="current-value">Nilai saat ini: {{ $data['usia'] }}</div>
                    </div>
                    
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <div class="radio-group">
                            <div class="radio-option">
                                <input type="radio" id="laki" name="jenis_kelamin" value="laki" 
                                    {{ $data['jenis_kelamin'] == 'laki' ? 'checked' : '' }} required>
                                <label for="laki">Laki-laki</label>
                            </div>
                            <div class="radio-option">
                                <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan"
                                    {{ $data['jenis_kelamin'] == 'perempuan' ? 'checked' : '' }}>
                                <label for="perempuan">Perempuan</label>
                            </div>
                        </div>
                        <div class="current-value">Nilai saat ini: 
                            {{ $data['jenis_kelamin'] == 'laki' ? 'Laki-laki' : 'Perempuan' }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan (kg):</label>
                        <input type="number" step="0.1" id="berat_badan" name="berat_badan" 
                            value="{{ $data['berat_badan'] }}" required>
                        <div class="current-value">Nilai saat ini: {{ $data['berat_badan'] }} kg</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan (cm):</label>
                        <input type="number" id="tinggi_badan" name="tinggi_badan" 
                            value="{{ $data['tinggi_badan'] }}" required>
                        <div class="current-value">Nilai saat ini: {{ $data['tinggi_badan'] }} cm</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">Aktivitas & Tujuan</div>
                    
                    <div class="form-group">
                        <label for="tingkat_aktivitas">Tingkat Aktivitas:</label>
                        <select id="tingkat_aktivitas" name="tingkat_aktivitas" required>
                            <option value="rendah" {{ $data['tingkat_aktivitas'] == 'rendah' ? 'selected' : '' }}>Rendah </option>
                            <option value="sedang" {{ $data['tingkat_aktivitas'] == 'sedang' ? 'selected' : '' }}>Sedang </option>
                            <option value="tinggi" {{ $data['tingkat_aktivitas'] == 'tinggi' ? 'selected' : '' }}>Tinggi </option>
                        </select>
                        <div class="current-value">Nilai saat ini: 
                            @if($data['tingkat_aktivitas'] == 'rendah') Rendah
                            @elseif($data['tingkat_aktivitas'] == 'sedang') Sedang
                            @else Tinggi @endif
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="tujuan">Tujuan:</label>
                        <select id="tujuan" name="tujuan" required>
                            <option value="turun" {{ $data['tujuan'] == 'turun' ? 'selected' : '' }}>Menurunkan berat badan</option>
                            <option value="jaga" {{ $data['tujuan'] == 'jaga' ? 'selected' : '' }}>Mempertahankan berat badan</option>
                            <option value="naik" {{ $data['tujuan'] == 'naik' ? 'selected' : '' }}>Menambah berat badan</option>
                        </select>
                        <div class="current-value">Nilai saat ini: 
                            @if($data['tujuan'] == 'turun') Menurunkan berat badan
                            @elseif($data['tujuan'] == 'jaga') Mempertahankan berat badan
                            @else Menambah berat badan @endif
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">Perbarui Perhitungan</button>
                <a href="{{ route('kalori.index') }}" class="btn btn-edit">Kembali</a>
            </form>

        @else
            <!-- Tampilan Hasil -->
            <div class="card">
                <div class="card-title">Data Pribadi</div>
                <div class="info-item">
                    <span class="info-label">Usia:</span>
                    <span>{{ $data['usia'] }} tahun</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jenis Kelamin:</span>
                    <span>{{ $data['jenis_kelamin'] == 'laki' ? 'Laki-laki' : 'Perempuan' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Berat Badan:</span>
                    <span>{{ $data['berat_badan'] }} kg</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tinggi Badan:</span>
                    <span>{{ $data['tinggi_badan'] }} cm</span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Aktivitas & Tujuan</div>
                <div class="info-item">
                    <span class="info-label">Tingkat Aktivitas:</span>
                    <span>
                        @if($data['tingkat_aktivitas'] == 'rendah') Rendah
                        @elseif($data['tingkat_aktivitas'] == 'sedang') Sedang
                        @else Tinggi @endif
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Faktor Aktivitas:</span>
                    <span>{{ $data['faktor_aktivitas'] }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tujuan:</span>
                    <span>
                        @if($data['tujuan'] == 'turun') Menurunkan berat badan
                        @elseif($data['tujuan'] == 'jaga') Mempertahankan berat badan
                        @else Menambah berat badan @endif
                    </span>
                </div>
            </div>

            <div class="card">
                <div class="card-title">Hasil Perhitungan</div>
                <div class="info-item">
                    <span class="info-label">Kebutuhan Kalori Harian:</span>
                    <span class="nutrisi-value">{{ round($data['total_kalori'], 0) }} kkal/hari</span>
                </div>
            </div>

            <a href="{{ route('kalori.edit') }}" class="btn btn-edit">Edit Data</a>
            <a href="{{ route('kalori.reset') }}" class="btn btn-reset">Reset Data</a>
        @endif
    </div>
</body>
</html>