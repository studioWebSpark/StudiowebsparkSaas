@component('mail::message')
# Votre projet entre en phase de développement ! 🚀

Cher(e) {{ $notifiable->name }},

Nous sommes ravis de vous informer que votre projet est entré en phase de développement active.

## Détails du projet
- **Nom du projet**: {{ $projectStatus->order->project_name }}
- **Progression**: {{ $projectStatus->progress }}%
- **Date de début**: {{ $projectStatus->status_changed_at->format('d/m/Y') }}

## Prochaines étapes
1. Développement des fonctionnalités
2. Intégration du design
3. Tests et optimisations
4. Révision avec vous

@component('mail::button', ['url' => route('client.project.show', $projectStatus->order_id)])
Suivre l'avancement
@endcomponent

Notre équipe travaille activement sur votre projet et vous tiendra informé(e) des avancées importantes.

Cordialement,<br>
L'équipe {{ config('app.name') }}

@component('mail::subcopy')
Si vous avez des questions, n'hésitez pas à nous contacter à {{ config('mail.from.address') }}
@endcomponent
@endcomponent