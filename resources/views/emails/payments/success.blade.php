@component('mail::message')
# Confirmation de paiement

Cher(e) {{ $user->name }},

Nous vous confirmons la réception de votre paiement pour votre projet.

**Référence de commande :** {{ $orderId }}

## Détails de votre projet
@if(isset($projectData['projectType']))
- Type de projet : {{ $projectData['projectType'] }}
@endif
@if(isset($projectData['personal']['clientType']))
- Type de client : {{ $projectData['personal']['clientType'] }}
@endif

@component('mail::button', ['url' => config('app.url').'/dashboard'])
Accéder à mon tableau de bord
@endcomponent

Nous allons traiter votre projet dans les plus brefs délais. Notre équipe vous contactera prochainement pour démarrer le développement.

Merci de votre confiance !

Cordialement,<br>
L'équipe {{ config('app.name') }}

<small>
    Ce message est généré automatiquement, merci de ne pas y répondre directement.<br>
    {{ config('app.name') }} - SIRET : [Votre SIRET]<br>
    TVA non applicable, art. 293 B du CGI
</small>
@endcomponent