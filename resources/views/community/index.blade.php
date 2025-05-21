@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Forum Komunitas</h2>

    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-muted">by {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                <a href="{{ route('community.show', $post->id) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
