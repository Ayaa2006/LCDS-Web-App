@extends('layouts.app')

@section('contents')
    <div class="container mt-5">
        <h1 class="mb-4">Modifier le blog</h1>
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="titre" class="form-label">Title</label>
        <input type="text" class="form-control" id="titre" name="titre" value="{{ $blog->titre }}" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required>{{ $blog->description }}</textarea>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Image</label>
        <input type="file" class="form-control" id="img" name="img">
        @if ($blog->img)
            <img src="{{ asset('storage/' . $blog->img) }}" alt="Blog Image" class="mt-2" width="150">
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @endsection
