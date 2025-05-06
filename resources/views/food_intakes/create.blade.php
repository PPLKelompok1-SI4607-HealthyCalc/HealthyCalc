@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header bg-white">
            <h2 class="mb-0">Tambah Makanan</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('food-intakes.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="food_name" class="form-label">Nama Makanan</label>
                    <input type="text" class="form-control" id="food_name" name="food_name" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="calories" class="form-label">Kalori (kal)</label>
                        <input type="number" class="form-control" id="calories" name="calories" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="protein" class="form-label">Protein (g)</label>
                        <input type="number" class="form-control" id="protein" name="protein" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="carbs" class="form-label">Karbohidrat (g)</label>
                        <input type="number" class="form-control" id="carbs" name="carbs" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fat" class="form-label">Lemak (g)</label>
                        <input type="number" class="form-control" id="fat" name="fat" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="meal_time" class="form-label">Waktu Makan</label>
                        <select class="form-select" id="meal_time" name="meal_time" required>
                            <option value="Sarapan" {{ request()->get('meal_time') == 'Sarapan' ? 'selected' : '' }}>Sarapan</option>
                            <option value="Makan Siang" {{ request()->get('meal_time') == 'Makan Siang' ? 'selected' : '' }}>Makan Siang</option>
                            <option value="Makan Malam" {{ request()->get('meal_time') == 'Makan Malam' ? 'selected' : '' }}>Makan Malam</option>
                            <option value="Camilan" {{ request()->get('meal_time') == 'Camilan' ? 'selected' : '' }}>Camilan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="consumed_at" class="form-label">Waktu Konsumsi</label>
                        <input type="time" class="form-control" id="consumed_at" name="consumed_at" required>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('food-intakes.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection