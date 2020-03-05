@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1 class="mr-2">Gestion des adhérents</h1>
    <ul>
        <li><a href="">Formulaire d'adhésion</a></li>
    </ul>
</div>
<div class="2-columns-form-layout">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <!-- start card -->
                <div class="card">
                    <!--begin::form-->
                <form action="{{route('user.store')}}" method="POST">
                    @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nom" class="ul-form__label">NOM :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-ID-2"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('nom') is-invalid" @enderror id="nom" placeholder="Entrez votre nom" data-cip-id="nom" name="nom">
                                    @error('nom')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('nom') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenom" class="ul-form__label">Prénom :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-ID-2"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('prenom') is-invalid" @enderror id="prenom" placeholder="Entrez votre prenom" data-cip-id="prenom" name="prenom">
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
                                <div class="form-group col-md-6">
                                    <label for="naissance_at" class="ul-form__label">Date de naissance :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Male"></i></span>
                                        </div>
                                    <input type="date" class="form-control @error('naissance_at') is-invalid" @enderror id="naissance_at" data-cip-id="naissance_at" name="naissance_at">
                                    @error('naissance_at')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('naissance_at') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="naissance_lieu" class="ul-form__label">Ville de naissance :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Map-Marker"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('naissance_lieu') is-invalid" @enderror id="naissance_lieu" placeholder="Entrez un nom de ville" data-cip-id="naissance_lieu" name="naissance_lieu">
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
                                    <input type="text" class="form-control @error('adresse') is-invalid" @enderror id="adresse" placeholder="Entrez votre adresse" data-cip-id="adresse" name="adresse">
                                    @error('adresse')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('adresse') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cp" class="ul-form__label">Code postal :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mailbox-Empty"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('cp') is-invalid" @enderror id="cp" placeholder="Entrez un code postal" data-cip-id="cp" name="cp">
                                    @error('cp')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('cp') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ville" class="ul-form__label">Ville :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mailbox-Empty"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('ville') is-invalid" @enderror id="ville" placeholder="Entrez un nom de ville" data-cip-id="ville" name="ville">
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
                                <div class="form-group col-md-6">
                                    <label for="tel" class="ul-form__label">Téléphone :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Old-Telephone"></i></span>
                                        </div>
                                    <input type="tel" class="form-control @error('tel') is-invalid" @enderror id="tel" placeholder="Numéro de téléphone sans espace, ni tirets" data-cip-id="tel" name="tel">
                                    @error('tel')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tel') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="ul-form__label">E-mail :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Mail-Forward"></i></span>
                                        </div>
                                    <input type="text" class="form-control @error('email') is-invalid" @enderror id="email" placeholder="Entrez votre email" data-cip-id="email" name="email">
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
                                    <label for="photo" class="ul-form__label">Photo d'identité :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Male"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('photo') is-invalid" @enderror" id="photo" name="photo">
                                            <label class="custom-file-label" for="photo" aria-describedby="inputGroupFileAddon02">Selection ou prendre une photo ...</label>
                                        </div>
                                        @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('photo') }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="certif" class="ul-form__label">Certificat médical :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Letter-Open"></i></span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('certif') is-invalid" @enderror" id="certif" name="certif">
                                            <label class="custom-file-label" for="certif" aria-describedby="inputGroupFileAddon02">Selection ou prendre une photo ...</label>
                                        </div>
                                        @error('certif')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('certif') }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="certif_at" class="ul-form__label">Date du certificat :</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="i-Male"></i></span>
                                        </div>
                                    <input type="date" class="form-control @error('certif_at') is-invalid" @enderror id="certif_at" data-cip-id="certif_at" name="certif_at">
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
                                    <label for="activite" class="ul-form__label">Activité principale :</label>
                                    <div class="p-3">
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="1">
                                            <span class="p-1">Aïki Jujutsu</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="1">
                                            <span class="p-1">Art plastique</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="1">
                                            <span class="p-1">Badminton</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="2" checked="checked">
                                            <span class="p-1">Cross Training</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="2">
                                            <span class="p-1">Futsal</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="2" checked="checked">
                                            <span class="p-1">Golf</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="2" checked="checked">
                                            <span class="p-1">Musculation / Remise en forme</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="p-3">
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="1">
                                            <span class="p-1">Licence temporaire</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="activite" value="1">
                                            <span class="p-1">Adhésion sans activité</span>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="origine" class="ul-form__label">Origine:</label>
                                    <br>
                                    <small class="">Si vous n'avez aucun lien avec le ministère des armées, selectionnez "Autre"</small>
                                    <div class="p-3">
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="1">
                                            <span class="p-1">Personnel civil du ministère des armées</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="2">
                                            <span class="p-1">Personnel sous statut militaire</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="2" checked="checked">
                                            <span class="p-1">Famille de civil et/ou militaire</span>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radio radio-primary">
                                            <input type="radio" name="origine" value="2" checked="checked">
                                            <span class="p-1">Autre</span>
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
                                        <button type="submit" class="btn  btn-primary m-1">Ajouter</button>
                                        <button type="button" class="btn btn-outline-secondary m-1">Annuler</button>


                                        <button type="button" class="btn  btn-danger m-1 footer-delete-right">Pas de fonction</button>
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
