@extends('layouts.tailwind-app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Buat Postingan Komunitas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('community.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Isi Postingan</label>
            <textarea name="content" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Posting</button>
    </form>
</div>
@endsection
