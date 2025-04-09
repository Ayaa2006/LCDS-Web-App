@extends('layouts.app')

@php
    use Illuminate\Support\Str;
@endphp

@section('contents')
<div class="container mt-5">
    <h1 class="mb-4">Messages des visiteurs</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $contact->name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>
                        <button 
    class="btn btn-sm btn-info view-message" 
    data-bs-toggle="modal" 
    data-bs-target="#messageModal"
    data-name="{{ $contact->name }} {{ $contact->last_name }}"
    data-email="{{ $contact->email }}"
    data-date="{{ $contact->created_at->format('d/m/Y H:i') }}"
    data-message="{{ $contact->message }}">
    <i class="fas fa-eye"></i> Voir
</button>


                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger fw-bold">
                            Aucun contact trouvé (même après insertion de test)
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


<!-- Modal pour voir le message complet avec une card -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    Détail du message
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
    <div class="card p-3">
        <p><strong>De :</strong> <span id="modalName">{{ $contact->name }} {{ $contact->last_name }}</span></p>
        <p><strong>Email :</strong> <span id="modalEmail">{{ $contact->email }}</span></p>
        <p><strong>Date :</strong> <span id="modalDate">{{ $contact->created_at->format('d/m/Y H:i') }}</span></p>
        <hr>
        <p><strong>Message :</strong></p>
        <p id="modalMessage" class="text-muted">{{ $contact->message }}</p>
    </div>
</div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery (obligatoire pour ton script JS) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




