@extends('layouts.sidebar')

@section('title', 'Create Category - Blog MSIB')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="bi bi-plus-circle"></i> Create New Category</h1>

        <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> Back
        </a>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda:
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-tags"></i> Category Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label"><i class="bi bi-card-text"></i> Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name') }}" placeholder="Enter category name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label"><i class="bi bi-file-earmark-text"></i> Description</label>
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                               value="{{ old('description') }}" placeholder="Enter category description">
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
