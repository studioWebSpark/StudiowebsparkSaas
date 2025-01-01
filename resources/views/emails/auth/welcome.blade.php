@component('mail::message')
# Bienvenue sur {{ config('app.name') }}

Cher(e) {{ $user->name }},

Nous sommes ravis de vous accueillir sur {{ config('app.name') }}. Votre compte a été créé avec succès et vous pouvez maintenant accéder à tous nos services.

@component('mail::panel')
**Informations importantes :**
- Votre compte est maintenant actif
- Vous pouvez accéder à votre espace personnel
- N'hésitez pas à compléter votre profil
@endcomponent

@component('mail::button', ['url' => config('app.url').'/dashboard', 'color' => 'primary'])
Accéder à mon espace
@endcomponent

@component('mail::table')
| Détails de votre compte ||
| ------------------------ | ----------------- |
| Nom | {{ $user->name }} |
| Email | {{ $user->email }} |
| Date d'inscription | {{ $user->created_at->format('d/m/Y') }} |
@endcomponent

@if(isset($projectData))
@component('mail::panel')
**Votre projet :**
- Type de projet : {{ $projectData['type'] ?? 'Non spécifié' }}
- Forfait choisi : {{ $projectData['forfait'] ?? 'Non spécifié' }}
@endcomponent
@endif

@component('mail::subcopy')
Si vous avez des questions ou besoin d'aide, notre équipe support est disponible pour vous accompagner.
@endcomponent

Cordialement,<br>
L'équipe {{ config('app.name') }}
@endcomponent