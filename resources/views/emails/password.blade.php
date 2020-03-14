@component('mail::message')
# Vos données de connexion au Club Sportif et Artistique

Bonjour <strong>{{ $adherent }}</strong> </br>

Voici vos données de connexion :</br>
- Login : <strong>{{ $email }}</strong> </br>
- Mot de passe : <strong>{{ $password }}</strong> </br>

@component('mail::button', ['url' => $url])
Se connecter
@endcomponent

Sportivement,<br>
Le bureau du CSADN
@endcomponent
