@component('mail::message')
# Bienvenue dans notre newsletter !

Merci de vous être inscrit à notre newsletter. Vous recevrez régulièrement :

• Les dernières tendances du web

• Des conseils pour votre présence en ligne

• Des actualités sur nos services

• Des offres exclusives


@component('mail::panel')
Pour vous désinscrire à tout moment, cliquez simplement sur le bouton ci-dessous.
@endcomponent

@component('mail::button', ['url' => route('newsletter.unsubscribe', ['token' => $newsletter->token]), 'color' => 'red'])
Se désinscrire
@endcomponent


Cordialement,
L'équipe {{ config('app.name') }}

___

Pour toute question, n'hésitez pas à nous contacter à {{ config('mail.from.address') }}
@endcomponent