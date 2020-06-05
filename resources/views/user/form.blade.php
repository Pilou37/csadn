@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    @if ($user ?? '')
        <h1 class="mr-2">Gestion des adhérents</h1>
        <ul>
            <li>Modification des informations</li>
        </ul>
    @else
        <h1 class="mr-2">Pré-inscription</h1>
        <ul>
            <li>Formulaire d'adhésion</li>
        </ul>
    @endif
</div>
<div class="2-columns-form-layout">
    <div class="">
        @if (!($user ?? ''))
        <p>Pour l'adhésion, une pré-inscription en ligne est OBLIGATOIRE.</p>
        <p>Une fois le formulaire rempli, un mail contenant vos données de connexion et la liste des document à fournir vous sera envoyé.</p>
        @endif
        <div class="row">
            <div class="col-lg-12">
                <!-- start card -->
                <div class="card">
                    <!--begin::form-->
                @if ($user ?? '')
                    <form action="{{route('user.update', $user)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                @else
                    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                        @csrf
                        @honeypot
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12 col-xl-2">
                                    <div class="p-3">
                                        @if (old('genre'))
                                            <?php $genre = old('genre') ?>
                                        @elseif ($user->genre ?? '')
                                            <?php $genre = $user->genre ?>
                                        @else
                                            <?php $genre = 1 ?>
                                        @endif
                                        <label class="radio radio-primary">
                                            <input type="radio" name="genre" value="1" @if ($genre == 1) checked @endif >
                                            <span class="p-1">Mr</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="genre" value="2" @if ($genre == 2) checked @endif >
                                            <span class="p-1">Mme</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-xl-5">
                                    <label for="nom" class="ul-form__label">NOM :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-ID-2"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('nom') is-invalid" @enderror id="nom" value="{{old('nom', $user->nom ?? '')}}" placeholder="Entrez votre nom" data-cip-id="nom" name="nom">
                                    @error('nom')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nom') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-xl-5">
                                    <label for="prenom" class="ul-form__label">Prénom :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-ID-2"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('prenom') is-invalid" @enderror id="prenom" value="{{old('prenom', $user->prenom ?? '')}}" placeholder="Entrez votre prenom" data-cip-id="prenom" name="prenom">
                                    @error('prenom')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('prenom') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="custom-separator"></div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="naissance_at" class="ul-form__label">Date de naissance :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Calendar-3"></i></span>
                                        </div>
                                    <input type="date" class="form-control @error('naissance_at') is-invalid" @enderror id="naissance_at" value="{{old('naissance_at', $user->naissance_at ?? '')}}" data-cip-id="naissance_at" name="naissance_at">
                                    @error('naissance_at')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('naissance_at') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="naissance_lieu" class="ul-form__label">Ville de naissance :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Map-Marker"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('naissance_lieu') is-invalid" @enderror id="naissance_lieu" value="{{old('naissance_lieu', $user->naissance_lieu ?? '')}}" placeholder="Entrez un nom de ville" data-cip-id="naissance_lieu" name="naissance_lieu">
                                    @error('naissance_lieu')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('naissance_lieu') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="custom-separator"></div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="adresse" class="ul-form__label">Adresse :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mailbox-Empty"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('adresse') is-invalid" @enderror id="adresse" value="{{old('adresse', $user->adresse ?? '')}}" placeholder="Entrez votre adresse" data-cip-id="adresse" name="adresse">
                                    @error('adresse')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('adresse') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cp" class="ul-form__label">Code postal :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mailbox-Empty"></i></span>
                                        </div>
                                    <input type="number" class="form-control @error('cp') is-invalid" @enderror id="cp" value="{{old('cp', $user->cp ?? '')}}" placeholder="Entrez un code postal" data-cip-id="cp" name="cp">
                                    @error('cp')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cp') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="ville" class="ul-form__label">Ville :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mailbox-Empty"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('ville') is-invalid" @enderror id="ville" value="{{old('ville', $user->ville ?? '')}}" placeholder="Entrez un nom de ville" data-cip-id="ville" name="ville">
                                    @error('ville')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('ville') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="custom-separator"></div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tel" class="ul-form__label">Téléphone :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Old-Telephone"></i></span>
                                        </div>
                                    <input type="tel" class="form-control tel @error('tel') is-invalid @enderror"  id="tel" value="{{old('tel', $user->tel ?? '')}}" placeholder="Entrez votre numéro de téléphone" data-cip-id="tel" name="tel" data-mask="09 99 99 99 99">
                                    @error('tel')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tel') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="email" class="ul-form__label">E-mail :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mail-Forward"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('email') is-invalid" @enderror id="email" value="{{old('email', $user->email ?? '')}}" placeholder="Entrez votre email" data-cip-id="email" name="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="custom-separator"></div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="photo" class="p-0 ul-form__label @error('photo') text-danger @enderror">Photo d'identité : {{ $errors->first('photo') }}</label>
                                    <br>
                                    <small class="">Vous avez la possibilité de prendre une photo avec une tablette ou téléphone</small>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-File-Pictures"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="photo-file custom-file-input @error('photo') is-invalid" @enderror" id="photo" value="{{old('photo')}}" name="photo">
                                            <label class="custom-file-label" for="photo" aria-describedby="inputGroupFileAddon02">Selection ou prendre une photo ...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="certif" class="p-0 ul-form__label @error('certif') text-danger @enderror">Certificat médical : {{ $errors->first('certif') }}</label>
                                    <br>
                                    <small class="">Vous avez la possibilité de prendre une photo avec une tablette ou téléphone</small>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Letter-Open"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="certif-file custom-file-input @error('certif') is-invalid" @enderror" id="certif" value="{{old('certif')}}" name="certif">
                                            <label class="custom-file-label" for="certif" aria-describedby="inputGroupFileAddon02">Selection ou prendre une photo ...</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="certif_at" class="ul-form__label">Date du certificat médical :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Calendar-3"></i></span>
                                        </div>
                                    <input type="date" class="form-control @error('certif_at') is-invalid" @enderror id="certif_at" value="{{old('certif_at', $user->certif_at ?? '')}}" data-cip-id="certif_at" name="certif_at">
                                    @error('certif_at')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('certif_at') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="custom-separator"></div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="activite_id" class="ul-form__label @error('activite_id') text-danger @enderror">Activité principale :  {{ $errors->first('activite_id') }}</label>
                                    <div class="p-3">
                                        @if ($activites = \App\Activite::orderBy('tarif', 'asc')->get())
                                        @if (old('activite_id'))
                                            <?php $activite_id = old('activite_id') ?>
                                        @elseif ($user->activite_id ?? '')
                                            <?php $activite_id = $user->activite_id ?>
                                        @else
                                            <?php $activite_id = 1 ?>
                                        @endif
                                        @foreach ($activites as $activite)
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite_id" value="{{$activite->id}}"
                                                @if ($activite->id == $activite_id)) checked @endif>
                                            <span class="p-1"><strong>{{$activite->nom}} - </strong>{{$activite->tarif}} €</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        @endforeach

                                    @else
                                        Aucune activitée connue
                                    @endif
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="origine" class="ul-form__label">Origine:</label>
                                    <br>
                                    <small class="">Si vous n'avez aucun lien avec le ministère des armées, selectionnez "Autre"</small>
                                    <div class="p-3">
                                        @if (old('origine'))
                                            <?php $origine = old('origine') ?>
                                        @elseif ($user->origine ?? '')
                                            <?php $origine = $user->origine ?>
                                        @else
                                            <?php $origine = 1 ?>
                                        @endif
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="1" @if ($origine == 1) checked @endif>
                                            <span class="p-1">Aucun lien avec le ministère des armées</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="2" @if ($origine == 2) checked @endif >
                                            <span class="p-1">Personnel civil du ministère des armées</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="3" @if ($origine == 3) checked @endif >
                                            <span class="p-1">Personnel militaire</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="4" @if ($origine == 4) checked @endif >
                                            <span class="p-1">Famille de civil ministère des armées et/ou militaire</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <small id="passwordHelpBlock" class="ul-form__text form-text ">
                                        Selectionnez le choix correspondant
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mc-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-outline-secondary m-1"  onclick="history.back()">Retour</button>
                                        <button type="submit" class="btn  btn-primary m-1 footer-delete-right">Valider</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- end::form -->
                </div>
                <!-- end card -->
            </div>

        </div>
        <!-- end of main row -->
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/form.js') }}"></script>
@endsection
