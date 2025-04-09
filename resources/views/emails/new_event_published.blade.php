<!DOCTYPE html>
<html>
<head>
    <title>Nouvel événement publié</title>
    <style>
        .event-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .event-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Un nouvel événement a été publié!</h1>
    
    <div class="event-card">
        <h2>{{ $event->nomEvent }}</h2>
        
        <p><strong>Description:</strong></p>
        <p>{{ $event->description }}</p>
        
        @if($event->mediaAssocie)
            @if(in_array(pathinfo($event->mediaAssocie, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                <img src="{{ $message->embed(storage_path('app/' . $event->mediaAssocie)) }}" 
                     alt="Image événement" class="event-image">
            @endif
        @endif
        
        <p><strong>Durée:</strong> {{ $event->nbrDeJours }} jours</p>
        <p><strong>Date de publication:</strong> {{ $event->datePublication?->format('d/m/Y H:i') ?? 'Immédiat' }}</p>
    </div>
    
    <p>Merci de votre abonnement à notre newsletter!</p>
</body>
</html>