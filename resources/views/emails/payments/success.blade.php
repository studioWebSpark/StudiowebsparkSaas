@component('mail::message')
# Confirmation de paiement

Cher {{ $user->name }},

Nous vous confirmons le paiement de votre commande.

Numéro de commande : {{ $order_number }}
Montant : {{ $amount }} €

@component('mail::panel')
**Détails de la commande :**
- Numéro de commande : {{ $order_number }}
- Montant total : {{ $amount }} €
@endcomponent

@component('mail::panel')
**Votre projet :**
- Type de projet : {{ $projectData['project']['projectType'] }}
- Forfait choisi : {{ $projectData['forfait']['selectedForfait'] }}
- Template choisi : {{ $projectData['template']['selectedTemplates'][0] ?? 'Aucun template sélectionné' }}
@endcomponent

@component('mail::button', ['url' => config('app.url').'/client/dashboard'])
Accéder à mon espace client
@endcomponent

Nous vous contacterons très prochainement pour démarrer votre projet.

Cordialement,<br>
L'équipe {{ config('app.name') }}

<small>
    Ce message est généré automatiquement, merci de ne pas y répondre directement.<br>
    {{ config('app.name') }} - SIRET : 90476131900022<br>
    TVA non applicable, art. 293 B du CGI
</small>
@endcomponent