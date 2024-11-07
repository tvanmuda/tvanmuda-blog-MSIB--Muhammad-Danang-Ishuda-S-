@extends('layouts.sidebar')

@section('title', 'Edit Post - Blog MSIB')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary"><i class="bi bi-pencil-square"></i> Edit Post</h1>

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
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-edit"></i> Edit Post Details</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label"><i class="bi bi-card-text"></i> Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $post->title) }}" placeholder="Enter post title">
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
                                  placeholder="Enter post content">{{ old('content', $post->content) }}</textarea>
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
                                    {{ $category->id == old('category_id', $post->category_id) ? 'selected' : '' }}>
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
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @if($post->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-thumbnail" width="150">
                            </div>
                        @endif
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Author -->
                    <div class="mb-3">
                        <label for="author_id" class="form-label"><i class="bi bi-people"></i> Author</label>
                        <select name="author_id" id="author_id" class="form-select @error('author_id') is-invalid @enderror">
                            <option value="">Choose Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ $author->id == old('author_id', $post->author_id) ? 'selected' : '' }}>
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
                               class="form-check-input" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                        <label for="is_published" class="form-check-label"><i class="bi bi-upload"></i> Publish</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Post
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
