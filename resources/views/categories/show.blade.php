@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4 text-primary"><i class="bi bi-tag"></i> Detail Kategori</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0">{{ $category->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $category->description }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('categories.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Kategori
            </a>
        </div>
    </div>
</div>
@endsection
