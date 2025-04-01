@extends('layouts.app')

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Gestion des tâches</h1>

    <!-- Ajouter une nouvelle tâche -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Ajouter une nouvelle tâche</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.add-task') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Titre de la tâche</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="point" class="form-label">Points</label>
                    <input type="number" class="form-control" id="point" name="point" required>
                    @error('point')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="CanLink" name="CanLink" value="1">
                    <label class="form-check-label" for="CanLink">Peut inclure des liens/images</label>
                    @error('CanLink')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Ajouter une tâche</button>
            </form>
        </div>
    </div>

    <!-- Liste des tâches existantes -->
    <h2 class="mt-5">Tâches existantes</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($tasks->isEmpty())
        <div class="alert alert-warning">Aucune tâche disponible.</div>
    @else
        <ul class="list-group">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $task->title }}</strong><br>
                        <small class="text-muted">{{ $task->description }}</small><br>
                        <span class="badge bg-info">Points : {{ $task->point }}</span>
                        @if($task->CanLink)
                            <span class="badge bg-success">Avec images</span>
                        @else
                            <span class="badge bg-secondary">Sans images</span>
                        @endif
                    </div>
                    <div>
                    <a href="{{ route('tasks.edit-task', $task->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                    
                    <form action="{{ route('tasks.delete-task', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
</form>
<a href="{{ route('tasks.submissions', $task->id) }}" class="btn btn-info btn-sm">
                <i class="fas fa-eye"></i> Voir soumissions
            </a>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection