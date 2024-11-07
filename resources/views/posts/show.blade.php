@extends('layouts.sidebar')

@section('title', $post->title . ' - Blog MSIB')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card mb-4">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <p class="text-muted">
                            Posted on {{ $post->created_at->format('F d, Y') }} in <strong>{{ $post->category->name }}</strong> by <strong>{{ $post->author->name }}</strong>
                        </p>
                        <p class="card-text">
                            {!! nl2br(e($post->content)) !!}
                        </p>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">&larr; Back to Home</a>
                        @auth
                            @if (Auth::id() === $post->author_id)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
