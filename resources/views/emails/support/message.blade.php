@component('mail::message')
# Nouveau message de support client

**Informations du client :**
- Nom : {{ $user->name }}
- Email : {{ $user->email }}

**Sujet :** {{ $subject }}

**Message :**
{{ $clientMessage }}

Cordialement,<br>
{{ config('app.name') }}
@endcomponent