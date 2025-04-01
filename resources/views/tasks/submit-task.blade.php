@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')
@section('contents')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Soumissions pour la tâche: {{ $task->title }}</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>

    @if($submissions->isEmpty())
        <div class="alert alert-info">Aucune soumission pour cette tâche.</div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Utilisateur</th>
                                <th>Statut</th>
                                <th>Fichiers</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($submissions as $submission)
                                <tr>
                                    
                                    <td>{{ $submission->user_name }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($submission->status == 'done') bg-success
                                            @elseif($submission->status == 'rejected') bg-danger
                                            @else bg-warning @endif">
                                            {{ $submission->status }}
                                        </span>
                                    </td>
                                    <td>
    @if(count($submission->files) > 0)
        @foreach($submission->files as $file)
            <div class="mb-2">
                <a href="{{ route('submissions.download', ['path' => $file['path']]) }}" 
                   download="{{ $file['name'] }}" 
                   class="d-block">
                    <i class="fas fa-file-image me-1"></i> Chemin: {{ $file['path'] }}
                </a>
                
            </div>
        @endforeach
    @else
        <span class="text-muted">Aucun fichier</span>
    @endif
</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($submission->status == 'waiting')
                                                <form action="{{ route('submissions.approve', $submission->id_Sub_task) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Approuver
                                                    </button>
                                                </form>
                                                <form action="{{ route('submissions.reject', $submission->id_Sub_task) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i> Rejeter
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection