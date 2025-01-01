@component('mail::message')
# Paiement annulé

Cher(e) {{ $user->name }},

Nous avons bien noté l'annulation de votre paiement.

**Référence d'annulation :** {{ $cancelId }}

## Détails du projet annulé
@if(isset($projectData['projectType']))
- Type de projet : {{ $projectData['projectType'] }}
@endif
@if(isset($projectData['personal']['clientType']))
- Type de client : {{ $projectData['personal']['clientType'] }}
@endif

Si vous avez rencontré des difficultés lors du paiement ou si vous avez des questions, n'hésitez pas à nous contacter. Notre équipe est là pour vous aider.

@component('mail::button', ['url' => config('app.url').'/demarrer-projet?step=4'])
Réessayer le paiement
@endcomponent

@component('mail::button', ['url' => config('app.url').'/contact', 'color' => 'red'])
Nous contacter
@endcomponent

Nous restons à votre disposition pour toute information complémentaire.

Cordialement,<br>
L'équipe {{ config('app.name') }}

<small>
    Ce message est généré automatiquement, merci de ne pas y répondre directement.<br>
    {{ config('app.name') }} - SIRET : [Votre SIRET]<br>
    TVA non applicable, art. 293 B du CGI
</small>
@endcomponent