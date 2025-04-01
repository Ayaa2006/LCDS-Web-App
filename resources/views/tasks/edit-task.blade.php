@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Éditer la Tâche</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tasks.update-task', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la tâche</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required>{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="point" class="form-label">Points</label>
                    <input type="number" class="form-control" id="point" name="point" value="{{ old('point', $task->point) }}" required>
                    @error('point')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="CanLink" name="CanLink" value="1" 
                        {{ old('CanLink', $task->CanLink) ? 'checked' : '' }}>
                    <label class="form-check-label" for="CanLink">Peut inclure des liens/images</label>
                    @error('CanLink')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Mettre à jour
                    </button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection