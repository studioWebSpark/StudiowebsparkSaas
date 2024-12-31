@component('mail::message')
# Merci pour votre commande !

Cher(e) {{ $user->name }},

@component('mail::panel')
### 📋 Détails de la commande
**Numéro de commande :** {{ $order['orderId'] }}

**Montant total :** {{ number_format($order['amount'], 2, ',', ' ') }}€
@endcomponent

@component('mail::panel')
### 🚀 Détails de votre projet
**Type de projet :** {{ $order['projectType'] }}

**Forfait choisi :** {{ $order['forfaitType'] }}

@if($order['forfaitType'] === 'starter')
#### ✨ Fonctionnalités du forfait starter :
@else
#### ✨ Fonctionnalités sélectionnées :
@endif

@foreach($order['features'] as $feature)
• {{ $feature }}<br>
@endforeach
@endcomponent

@component('mail::panel')
### 📅 Prochaines étapes

**1. Analyse immédiate de votre projet**
Notre équipe technique analysera votre projet (2-4h)

**2. Email de confirmation du début du projet**
Vous recevrez un planning détaillé

**3. Prise de contact par votre chef de projet dédié**
• Validation de vos besoins spécifiques
• Planning de développement
• Points de suivi réguliers

@if($order['forfaitType'] === 'premium' || $order['forfaitType'] === 'standard')
**4. Étude approfondie marketing**
• Analyse de votre marché
• Stratégie de communication
• Plan d'action réseaux sociaux
• Planning des points d'étape marketing
@endif
@endcomponent

### 🔍 Pour Suivre votre projet

@component('mail::button', ['url' => route('dashboard'), 'color' => 'primary'])
Accéder à mon tableau de bord
@endcomponent

@if($order['forfaitType'] === 'premium' || $order['forfaitType'] === 'standard')
@component('mail::panel')
### ⭐ Note importante
Notre équipe marketing vous contactera dans les heures qui suivent pour débuter l'étude de marché et définir votre stratégie de communication.
@endcomponent
@endif

@component('mail::panel')
### 📞 Besoin d'assistance ?
• Email : studiowebspark@gmail.com

• Téléphone : +33 7 67 17 57 24
@endcomponent

Nous sommes impatients de commencer votre projet !

Cordialement,
L'équipe StudioWebspark
@endcomponent