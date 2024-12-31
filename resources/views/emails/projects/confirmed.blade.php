@component('mail::message')
# Votre projet est confirmé !

Cher(e) {{ $project->first_name }},

Nous vous remercions pour votre confiance. Votre paiement a bien été reçu et votre projet est maintenant confirmé.

**Détails de votre commande :**
- Numéro de commande : {{ $project->order_number }}
- Type de projet : {{ $project->project_type }}
- Forfait : {{ $project->forfait_type }}
- Montant total : {{ number_format($project->total_amount, 2, ',', ' ') }}€

**Prochaines étapes :**
1. Notre équipe technique va analyser votre projet (2-4h)
2. Vous recevrez un email de confirmation du début du projet
3. Votre chef de projet vous contactera pour :
- Valider vos besoins spécifiques
- Établir le planning de développement
- Organiser les points de suivi

@component('mail::button', ['url' => route('dashboard')])
Accéder à mon tableau de bord
@endcomponent

Nous sommes impatients de commencer votre projet !

Cordialement,<br>
L'équipe StudioWebspark
@endcomponent