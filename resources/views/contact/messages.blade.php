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
                    <th>Objet</th>
                    <th>Message</th>
                    <th>Action</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $contact->name }} {{ $contact->last_name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->object }}</td>
                        <td>{{ Str::limit($contact->message, 50) }}</td>
                        <td>
            @if($contact->reponses->count() > 0)
                <span class="badge bg-success">Répondu</span>
            @else
                <span class="badge bg-warning text-dark">En attente</span>
            @endif
        </td>
                        <td>
                        <button 
    class="btn btn-sm btn-info view-message" 
    data-bs-toggle="modal" 
    data-bs-target="#messageModal"
    data-id="{{ $contact->id }}"
    data-name="{{ $contact->name }} {{ $contact->last_name }}"
    data-objet="{{ $contact->object }}"
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
                <h5 class="modal-title">Détail du message</h5>
                  </div>
            <div class="modal-body">
                <div class="card p-3">
                    <p><strong>De :</strong> <span id="modalName"></span></p>
                    <p><strong>Email :</strong> <span id="modalEmail"></span></p>
                    <p><strong>Date :</strong> <span id="modalDate"></span></p>
                    <p><strong>Objet :</strong> <span id="modalObjet"></span></p>
                    <hr>
                    <p><strong>Message :</strong></p>
                    <p id="modalMessage" class="text-muted"></p>
                </div>
                
                <!-- Section Réponse -->
                <div class="mt-4">
                    <h5>Répondre à : <span id="modalObjetReply"></span></h5>
                    <form id="replyForm" method="POST">
                        @csrf
                        <input type="hidden" id="contactId" name="contact_id">
                        <div class="mb-3">
                            <label for="replySubject" class="form-label">Objet</label>
                            <input type="text" class="form-control" id="replySubject" name="subject">
                        </div>
                        <div class="mb-3">
                            <label for="replyMessage" class="form-label">Votre réponse</label>
                            <textarea class="form-control" id="replyMessage" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i> Envoyer la réponse
                        </button>
                    </form>
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

@section('scripts')
<script>
$(document).ready(function() {
    // Afficher les détails du message dans la modal
    $('.view-message').click(function() {
        
        const contactId = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const date = $(this).data('date');
        const objet = $(this).data('objet');
        const message = $(this).data('message');
        console.log('Data:', $(this).data());
        // Remplir les champs de la modal
        $('#modalName').text(name);
        $('#modalEmail').text(email);
        $('#modalDate').text(date);
        $('#modalMessage').text(message);
        $('#contactId').val(contactId);
        $('#modalObjet').text(objet);
        $('#modalObjetReply').text(objet);
        
        // Pré-remplir le sujet avec "Re: " si l'objet original existe
    const replySubject = objet ? 'Réponse sur: ' + objet : 'Réponse à votre message';
    $('#replySubject').val(replySubject);

        // Mettre à jour l'action du formulaire
        $('#replyForm').attr('action', '/contact/' + contactId + '/reply');
    });

    // Gestion du formulaire de réponse
    $('#replyForm').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(response) {
                if(response.success) {
                    alert('Réponse envoyée avec succès');
                    $('#messageModal').modal('hide');
                    location.reload();
                }
            },
            error: function(xhr) {
                alert('Une erreur est survenue: ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>
@endsection
@yield('scripts')




