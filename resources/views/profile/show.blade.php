@extends('layouts.sidebar') 

@section('title', 'Profile Detail')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary"><i class="bi bi-person-circle"></i> Profile Detail</h1>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>{{ $user->name }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> <span class="text-muted">{{ $user->email }}</span></p>
            <p><strong>Nama:</strong> <span class="text-muted">{{ $user->name }}</span></p>
            <p><strong>Terdaftar Sejak:</strong> <span class="text-muted">{{ $user->created_at->format('d M Y') }}</span></p>
        </div>
    </div>

   
</div>
@endsection
