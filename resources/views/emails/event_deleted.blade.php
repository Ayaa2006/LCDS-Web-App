<!DOCTYPE html>
<html>
<head>
    <title>Événement terminé</title>
    <style>
        .event-card {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <h1>Un événement a été marqué comme terminé</h1>
    
    <div class="event-card">
        <h2>{{ $event->nomEvent }}</h2>
        <p>Nous vous informons que cet événement est maintenant terminé.</p>
        
        <p><strong>Description:</strong></p>
        <p>{{ $event->description }}</p>
        
        <p>Merci d'avoir suivi cet événement!</p>
    </div>
    
    <p>L'équipe de gestion des événements</p>
</body>
</html>