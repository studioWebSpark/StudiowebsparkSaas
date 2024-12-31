@component('mail::message')
# Bienvenue dans notre newsletter !

Merci de vous être inscrit(e) à notre newsletter.

Vous recevrez régulièrement :
- Nos dernières actualités
- Des conseils d'experts
- Des offres exclusives
- Des cas clients inspirants

Si vous souhaitez vous désinscrire, cliquez sur le lien ci-dessous :

@component('mail::button', ['url' => route('newsletter.unsubscribe', ['email' => $email])])
Se désinscrire
@endcomponent

À bientôt !<br>
{{ config('app.name') }}
@endcomponent