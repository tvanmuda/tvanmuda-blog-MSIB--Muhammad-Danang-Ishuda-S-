@extends('layouts.sidebar')

@section('title', 'Create Post - Blog MSIB')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="bi bi-plus-circle"></i> Create New Post</h1>

        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary mb-3">
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
                <h5 class="mb-0"><i class="bi bi-pencil-square"></i> Post Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-card-text"></i> Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title') }}" placeholder="Enter post title">
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label for="content" class="form-label"><i class="bi bi-file-text"></i> Content</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" rows="5"
                                  placeholder="Enter post content">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label"><i class="bi bi-tags"></i> Category</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label"><i class="bi bi-image"></i> Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event)">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-2">
                            <img id="image-preview" src="{{ old('image') ? asset('storage/' . old('image')) : '#' }}" alt="Image Preview" class="img-thumbnail d-none" width="150">
                        </div>
                    </div>

                    <!-- Author -->
                    <div class="mb-3">
                        <label for="author_id" class="form-label"><i class="bi bi-people"></i> Author</label>
                        <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror">
                            <option value="">Choose Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Publish Checkbox -->
                    <div class="form-check mb-3">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" id="is_published"
                               class="form-check-input" {{ old('is_published') ? 'checked' : '' }}>
                        <label for="is_published" class="form-check-label"><i class="bi bi-upload"></i> Publish</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script for Image Preview -->
    <script>
        function previewImage(event) {
            const preview = document.getElementById('image-preview');
            const file = event.target.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('d-none');
            } else {
                preview.src = '#';
                preview.classList.add('d-none');
            }
        }
    </script>
@endsection
