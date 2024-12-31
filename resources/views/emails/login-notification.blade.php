@component('mail::message')
# Nouvelle connexion

Bonjour {{ $user->name }},

Une nouvelle connexion a été détectée sur votre compte.

**Détails de la connexion :**
- Date : {{ now()->format('d/m/Y H:i') }}
- Adresse IP : {{ $ipAddress }}
- Navigateur : {{ $device }}

Si vous n'êtes pas à l'origine de cette connexion, veuillez sécuriser votre compte immédiatement.

@component('mail::button', ['url' => route('profile.show')])
Gérer mon compte
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent