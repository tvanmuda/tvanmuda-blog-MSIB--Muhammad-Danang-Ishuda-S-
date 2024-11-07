@extends('layouts.app')

@section('title', $post->title . ' - Blog MSIB')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- Detail Post -->
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top rounded-top" alt="{{ $post->title }}" style="width: 100%; height: auto;">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title fw-bold">{{ $post->title }}</h1>
                        <p class="text-muted mb-4">
                            <i class="fas fa-calendar-alt"></i> {{ $post->created_at->format('F d, Y') }}
                            &nbsp;&nbsp;
                            <i class="fas fa-folder"></i> {{ $post->category->name }}
                            &nbsp;&nbsp;
                            <i class="fas fa-user"></i> {{ $post->author->name }}
                        </p>
                        <hr>
                        <p class="card-text">
                            {!! nl2br(e($post->content)) !!}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('frontend.home') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-arrow-left"></i> Back to Home
                            </a>
                            @auth
                                @if (Auth::id() === $post->author_id)
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i> Edit Post
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artikel Lainnya -->
            <div class="col-lg-4">
                <h3 class="mb-4">Lihat Artikel Lainnya</h3>
                @foreach ($posts as $relatedPost)
                    <div class="card mb-3 shadow-sm">
                        <a href="{{ route('posts.show', $relatedPost->id) }}">
                            @if ($relatedPost->image)
                                <img src="{{ asset('storage/' . $relatedPost->image) }}" class="card-img-top" alt="{{ $relatedPost->title }}" style="width: 100%; height: 150px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $relatedPost->title }}</h5>
                                <p class="text-muted">
                                    <i class="fas fa-calendar-alt"></i> {{ $relatedPost->created_at->format('F d, Y') }}
                                </p>
                                <a href="{{ route('frontend.details', $post->id) }}" class="btn btn-primary mt-3">Read More &rarr;</a>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>            
        </div>
    </div>
@endsection
