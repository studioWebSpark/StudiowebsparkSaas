@component('mail::message')
# Confirmation de commande

Cher(e) {{ $user->name }},

Nous vous remercions pour votre commande sur {{ config('app.name') }}. Voici le récapitulatif de votre commande :

@component('mail::panel')
## Informations client
- Nom : {{ $user->name }}
- Email : {{ $user->email }}
- Date de commande : {{ now()->format('d/m/Y à H:i') }}
@endcomponent

@component('mail::panel')
## Détails du projet
- Type de projet : {{ $orderData['project']['projectType'] }}
- Description : {{ $orderData['project']['description'] }}

### Fonctionnalités sélectionnées :
@foreach($orderData['project']['selectedFeatures'] ?? [] as $feature)
- {{ $feature }}
@endforeach
@endcomponent

@component('mail::panel')
## Forfait choisi
- Nom du forfait : {{ $orderData['forfait']['selectedForfait'] }}
- Prix : {{ number_format($orderData['forfait']['forfaitDetails']['price'], 2, ',', ' ') }} €
@endcomponent

@if(isset($orderData['template']['selectedTemplates']))
@component('mail::panel')
## Template sélectionné
@foreach($orderData['template']['selectedTemplates'] as $template)
- {{ $template['name'] }}
@endforeach
@endcomponent
@endif

@component('mail::table')
| Récapitulatif | Montant |
|---------------|---------|
| **Total** | **{{ number_format($orderData['forfait']['forfaitDetails']['price'], 2, ',', ' ') }} €** |
@endcomponent

## Informations légales

- Conformément à l'article L.121-20-3 du Code de la consommation, nous nous engageons à vous livrer votre projet dans les délais convenus.
- TVA non applicable, art. 293 B du CGI
- Vous disposez d'un droit de rétractation de 14 jours à compter de la date de cette commande.
- Vos données personnelles sont traitées conformément au RGPD (Règlement Général sur la Protection des Données).

Pour toute question concernant votre commande, vous pouvez nous contacter à l'adresse : {{ config('mail.from.address') }}

@component('mail::button', ['url' => config('app.url').'/dashboard'])
Accéder à mon espace client
@endcomponent

Cordialement,<br>
L'équipe {{ config('app.name') }}

<small>
    Ce message est généré automatiquement, merci de ne pas y répondre directement.<br>
    {{ config('app.name') }} - SIRET : [Votre SIRET]<br>
    TVA non applicable, art. 293 B du CGI<br>
    [Votre adresse complète]
</small>
@endcomponent