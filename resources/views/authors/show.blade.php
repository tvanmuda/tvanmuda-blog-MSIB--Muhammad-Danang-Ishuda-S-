@extends('layouts.sidebar')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary"><i class="bi bi-person-circle"></i> Detail Penulis</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Author: {{ $author->name }}</h3>
        </div>
        <div class="card-body">
            @if ($author->profile_picture) <!-- Gambar profil -->
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $author->profile_picture) }}" alt="Profile Picture" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                </div>
            @endif
            <div class="mb-3">
                <strong>Email:</strong> <span class="text-muted">{{ $author->email }}</span>
            </div>
            <div class="mb-3">
                <strong>Bio:</strong>
                <p class="text-muted">{{ $author->bio ?? 'No biography available.' }}</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
