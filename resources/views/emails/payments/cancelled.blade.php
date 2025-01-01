@component('mail::message')
# Paiement annulé

Cher(e) {{ $user->name }},

Nous avons bien noté l'annulation de votre paiement.

**Référence d'annulation :** {{ $cancelId }}

## Votre projet est sauvegardé
Bonne nouvelle : toutes les informations de votre projet sont conservées dans votre espace client. Vous pourrez reprendre votre projet exactement là où vous l'avez laissé quand vous le souhaiterez.

## Récapitulatif du projet en attente
@if(isset($projectData['projectType']))
- Type de projet : {{ $projectData['projectType'] }}
@endif
@if(isset($projectData['forfait']))
- Formule : {{ $projectData['forfait']['selectedForfait'] }}
- Montant : {{ number_format($projectData['forfait']['forfaitDetails']['price'], 2, ',', ' ') }} €
@endif

## Besoin d'aide ?
- Vous avez rencontré un problème technique ?
- Vous souhaitez discuter de votre projet ?
- Vous avez des questions sur nos formules ?

Notre équipe est là pour vous aider !

@component('mail::button', ['url' => config('app.url').'/demarrer-projet?step=4'])
Reprendre mon projet
@endcomponent

@component('mail::button', ['url' => config('app.url').'/contact', 'color' => 'red'])
Contacter un conseiller
@endcomponent

Nous restons à votre disposition pour toute information complémentaire.

Cordialement,<br>
L'équipe {{ config('app.name') }}

<small>
    Ce message est généré automatiquement, merci de ne pas y répondre directement.<br>
    {{ config('app.name') }} - SIRET : 90476131900022<br>
    TVA non applicable, art. 293 B du CGI
</small>
@endcomponent