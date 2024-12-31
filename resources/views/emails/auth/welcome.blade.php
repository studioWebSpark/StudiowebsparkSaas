@component('mail::message')
# Bienvenue {{ $user->name }} !

Merci de vous être inscrit sur {{ config('app.name') }}.

@component('mail::button', ['url' => route('dashboard')])
Accéder à mon compte
@endcomponent

À bientôt,<br>
{{ config('app.name') }}
@endcomponent