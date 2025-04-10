<!DOCTYPE html>
<html>
<head>
    <title>{{ $subject }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; font-size: 12px; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>La Casa de Selfie</h2>
        </div>
        
        <div class="content">
            <h3>{{ $subject }}</h3>
            
            <p>Bonjour,</p>
            
            <p>Nous vous remercions pour votre message :</p>
            <blockquote style="background: #f8f9fa; padding: 10px; border-left: 4px solid #ddd;">
                {{ $originalMessage }}
            </blockquote>
            
            <p>Voici notre réponse :</p>
            <div style="background: #f0f8ff; padding: 15px; border-radius: 5px;">
                {!! nl2br(e($replyMessage)) !!}
            </div>
            
            <p style="margin-top: 20px;">
                Cordialement,<br>
                L'équipe de La Casa de Selfie
            </p>
        </div>
        
        <div class="footer">
            <p>Cet email a été envoyé en réponse à votre demande sur notre site.</p>
        </div>
    </div>
</body>
</html>