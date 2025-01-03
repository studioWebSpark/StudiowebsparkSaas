@component('mail::message')
# 🎉 Félicitations ! Votre projet est terminé ! 🎉

Cher(e) {{ $notifiable->name }},

Nous sommes ravis de vous annoncer que votre projet est maintenant terminé et prêt à être lancé !

## Récapitulatif du projet
- **Nom du projet**: {{ $projectStatus->order->project_name }}
- **Date de finalisation**: {{ $projectStatus->status_changed_at->format('d/m/Y') }}
- **URL de votre site**: [{{ $projectStatus->order->project_url }}]({{ $projectStatus->order->project_url }})

## Prochaines étapes
1. Accédez à votre nouveau site web
2. Vérifiez toutes les fonctionnalités
3. Commencez à utiliser votre espace d'administration

@component('mail::button', ['url' => $projectStatus->order->project_url])
Voir mon site
@endcomponent

@component('mail::panel')
### Support et maintenance
Nous restons à votre disposition pour :
- Support technique
- Mises à jour de sécurité
- Évolutions futures
@endcomponent


Merci de votre confiance !

Cordialement,<br>
L'équipe {{ config('app.name') }}

@component('mail::subcopy')
Pour toute question, contactez-nous à {{ config('mail.from.address') }}
@endcomponent
@endcomponent