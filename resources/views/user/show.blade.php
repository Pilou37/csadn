@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1 class="mr-2">Gestion des adhérents</h1>
    <ul>
        <li><a href="">Information adhérent</a></li>
        <li>{{$user->nom}}</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-header">
                <h4 class="card-title mb-3">Profil de {{$user->nom}} {{$user->prenom}} | <small> N° de dossier : </small>{{$user->id}} </h4>
                <?php $validationOk = App\Saison::isInActualSaison($user->validation_at) ?>
                <?php $saison = \App\Saison::getActualSaison() ?>
                <?php $licenceOk = $user->saisons->find($saison->id) ?>

                @if (!$validationOk)
                <div class="row">
                    <div class="col">
                        <div class="alert alert-card alert-warning" role="alert"><strong>Votre pré-inscription doit être validée</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="m-0">Afin de valider votre inscription, merci de transmettre à un bénévole du CSADN les documents suivants :</p>
                            <p class="m-0">- Le formulaire d'adhésion avec reçu de règlement.</p>
                            <p class="m-0">- Une photo d'identité.</p>
                            <p class="m-0">- Votre cerficat médical en cas de nouvelle adhésion ou renouvellement de + de 3 ans.</p>
                            <p class="m-0">- Le règlement correspondant à votre activité </p>

                        </div>
                    </div>
                </div>
                @endif
                @if (!$certif = $user->certif)
                <div class="row">
                    <div class="col">
                        <div class="alert alert-card alert-danger" role="alert"><strong>Vous n'avez pas fournis votre certificat médical en ligne</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="m-0">Si vous avez la possibilite de le photographier ou scanner, merci de nous le transmettre en modifiant vos informations.</p>
                        </div>
                    </div>
                </div>
                @endif
                @if ($user->photo == 'photo_identite/no-image.png')
                <div class="row">
                    <div class="col">
                        <div class="alert alert-card alert-danger" role="alert"><strong>Vous n'avez pas fournis votre photo d'identité en ligne</strong>
                            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="m-0">Si vous avez la possibilite de la scanner ou vous photographier, merci de nous la transmettre en modifiant vos informations.</p>
                        </div>
                    </div>
                </div>
                @endif
                <div class="progress mb-3">
                    @if ($licenceOk)
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Licence OK</div>
                    @else
                        @if ($validationOk)
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Dossier validé - Demande de licence en cours ...</div>
                        @else
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Dossier en cours de validation ...</div>
                        @endif
                    @endif

                </div>

                <form action="{{route('user.maj', $user)}}" method="POST">
                    @csrf

                    @can('secretariat')
                    <div class="row">
                        <div class="col-6 col-md-3 form-group">
                            <label class="switch switch-success mr-3 @error('doc_check') text-danger @enderror">
                                <span>Dossier complet </span>
                                <?php $saison = \App\Saison::getActualSaison() ?>
                                <input type="checkbox" name="doc_check" id="doc_check" value="1"
                                @if ($validationOk)
                                checked
                                @endif>
                                <span class="slider"></span>
                            </label>
                            <div class="invalid-feedback">
                                {{ $errors->first('doc_check') }}
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="switch switch-success mr-3 @error('licence_check') text-danger @enderror">
                                <span>Licence saisie</span>
                                <input type="checkbox" name="licence_check" id="licence_check" value="{{$saison->id}}"
                                @if ($licenceOk)
                                    checked
                                @endif>
                                <span class="slider"></span>
                            </label>
                            <div class="invalid-feedback">
                                {{ $errors->first('licence_check') }}
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                        <input type="number" name="licence" id="licence" class="form-control form-control-rounded @error('licence') is-invalid @enderror" placeholder="Numéro de licence" value="{{$user->licence}}">
                            <div class="invalid-feedback">
                                {{ $errors->first('licence') }}
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="submit" class="btn  btn-primary btn-block m-1">Valider</button>
                        </div>
                    </div>
                    @endcan
                    @can('administrateur')
                    <div class="row mt-4">
                        <div class="col-6 col-md-2">
                            Fonctions :
                        </div>
                        <?php $roles = App\Role::all(); ?>
                        @foreach ($roles as $role)
                        <div class="col-6 col-md-2 form-group">
                            <label class="switch switch-success mr-3">
                                <span>{{ ucfirst($role->nom) }} </span>
                                <input type="checkbox" name="roles[]" id="{{ $role->id }}" value="{{ $role->id }}"
                                    @foreach ($user->roles as $userRole)
                                        @if ($userRole->id == $role->id)
                                            checked
                                        @endif
                                    @endforeach>
                                <span class="slider"></span>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endcan
                </form>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <div class="col-md-12">
                                    <h4>Nom :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->nom}}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="col-md-12">
                                    <h4>Prénom :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->prenom}}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="col-md-12">
                                    <h4>Né(e) le :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{ $user->naissance_at_show }}
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12 mt-2">
                                <div class="col-md-12">
                                    <h4>Adresse :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->adresse}}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="col-md-12">
                                    <h4>CP :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->cp}}
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <div class="col-md-12">
                                    <h4>Ville :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->ville}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div class="col-md-12">
                                    <h4>Téléphone :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->tel}}
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="col-md-12">
                                    <h4>Email :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="col-md-12">
                                    <h4>Certificat le :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    @if ($certif_at = $user->certif_at_show)
                                    {{ $certif_at }}
                                    @else
                                    <span class="badge badge-danger">Aucune date !</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 mt-2">
                                <div class="col-md-12">
                                    <h4>Certificat :</h4>
                                </div>
                                <div class="col-md-12 ml-3">
                                    @if ($certif = $user->certif)
                                        <a href="{{ asset('storage/'.$user->certif) }}" class="badge badge-info m-2" target="_blank">Voir le certificat</a>
                                    @else
                                        <span class="badge badge-danger">Pas de certificat</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="{{ asset('storage/'.$user->photo) }}" alt="photo_profil" class="img-thumbnail">
                    </div>
                </div>

                <hr>
                @can('secretariat')
                <a href="{{route('user.confirmation',$user)}}" class="btn  btn-danger m-1 ">Supprimer adhérent</a>
                @endcan
                @can('comptabilite', $user)
                <a href="{{route('reglement.create',$user)}}" class="btn  btn-success m-1 footer-delete-right">+ Ajouter un règlement</a>
                @endcan

                @can('edit-user', $user)
                    <a href="{{route('user.edit',$user)}}" class="btn  btn-warning m-1 footer-delete-right">Modifier les informations</a>
                @endcan
                <button type="button" class="btn btn-outline-secondary m-1 footer-delete-right"  onclick="history.back()">Retour</button>
            </div>

        </div>
    </div>
</div>
@endsection
