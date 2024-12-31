@component('mail::message')
# Votre projet est en attente de paiement

Cher(e) {{ $user->name }},

Nous avons bien reçu votre demande de projet. Voici un récapitulatif :

**Détails de votre projet :**
- Type de projet : {{ $project->form_data_step_1['type'] ?? 'Non spécifié' }}
- Budget estimé : {{ $project->form_data_step_3['budget'] ?? 'Non spécifié' }}€

Pour finaliser votre projet, il ne vous reste plus qu'à procéder au paiement.

@component('mail::button', ['url' => route('project.payment', ['id' => $project->id])])
Procéder au paiement
@endcomponent

Si vous avez des questions, n'hésitez pas à nous contacter.

Cordialement,<br>
{{ config('app.name') }}
@endcomponent