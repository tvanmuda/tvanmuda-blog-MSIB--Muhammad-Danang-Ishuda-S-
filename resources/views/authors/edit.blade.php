@extends('layouts.sidebar')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4 text-primary"><i class="bi bi-person-fill"></i> Edit Author</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $author->name }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $author->email }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="bio">Bio</label>
            <textarea name="bio" class="form-control" id="bio" rows="4">{{ $author->bio }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('authors.index') }}" class="btn btn-outline-secondary ms-2">Back</a>
    </form>
</div>
@endsection
