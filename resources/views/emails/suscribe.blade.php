@component('mail::message')
# Votre adhésion au Club Sportif et Artistique

Bonjour <strong>{{ $adherent }}</strong> </br>

Nous vous confirmons la création de votre compte sur le site du CSADN.

<strong>Vous recevrez dans un deuxième mail vos informations de connexion.</strong>

En vous connectant, vous pouvez à tout moment :</br>
- modifier vos données</br>
- suivre l'avancée de votre dossier</br>
- renouveller votre licence l'année prochaine</br>


@component('mail::button', ['url' => $url])
Se connecter
@endcomponent

Sportivement,<br>
Le bureau du CSADN
@endcomponent
