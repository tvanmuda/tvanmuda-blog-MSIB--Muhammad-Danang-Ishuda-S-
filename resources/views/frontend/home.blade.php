@extends('layouts.app')

@section('title', 'Home - Blog MSIB')

@section('content')
    <h1 class="text-center mb-4">Welcome to Blog MSIB</h1>

    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('frontend.details', $post->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        {{ $post->created_at->format('M d, Y') }} | {{ $post->category->name }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
@endsection