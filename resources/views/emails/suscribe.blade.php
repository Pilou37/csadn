@component('mail::message')
# Votre adhésion au Club Sportif et Artistique

Bonjour <strong>{{ $adherent }}</strong> </br>

Nous vous confirmons la création de votre sur le site du CSADN.

En vous connectant, vous pouvez à tout moment :</br>
- modifier vos données</br>
- suivre l'avancée de votre dossier</br>
- renouveller votre licence l'année prochaine</br>

Voici vos données de connexion :</br>
- Login : <strong>{{ $email }}</strong> </br>
- Mot de passe : <strong>{{ $password }}</strong> </br>

@component('mail::button', ['url' => $url])
Se connecter
@endcomponent

Sportivement,<br>
Le bureau du CSADN
@endcomponent
