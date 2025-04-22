<form action="{{ route('kalori.hitung') }}" method="POST">
    @csrf
    <label>Usia: <input type="number" name="usia"></label><br>
    <label>Jenis Kelamin:
        <select name="jenis_kelamin">
            <option value="laki">Laki-laki</option>
            <option value="perempuan">Perempuan</option>
        </select>
    </label><br>
    <label>Berat Badan (kg): <input type="number" name="berat_badan"></label><br>
    <label>Tinggi Badan (cm): <input type="number" name="tinggi_badan"></label><br>
    <label>Tingkat Aktivitas:
        <select name="tingkat_aktivitas">
            <option value="rendah">Rendah</option>
            <option value="sedang">Sedang</option>
            <option value="tinggi">Tinggi</option>
        </select>
    </label><br>
    <label>Tujuan:
        <select name="tujuan">
            <option value="turun">Turun Berat Badan</option>
            <option value="jaga">Menjaga Berat Badan</option>
            <option value="naik">Naik Berat Badan</option>
        </select>
    </label><br>
    <button type="submit">Hitung Sekarang</button>
</form>
