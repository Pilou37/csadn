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
                <h4 class="card-title mb-3">Profil de {{$user->nom}} {{$user->prenom}}</h4>
                <form action="{{route('user.maj', $user)}}" method="POST">
                    @csrf
                    @can('secretariat')


                    <div class="row">
                        <div class="col-6 col-md-3 form-group">
                            <label class="switch switch-success mr-3 @error('doc_check') text-danger @enderror">
                                <span>Dossier complet </span>
                                <?php $saison = \App\Saison::getActualSaison() ?>
                                <input type="checkbox" name="doc_check" id="doc_check" value="1"
                                @if ($user->validation_at)
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
                                @if ($saison = $user->saisons->find($saison->id))
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
                    <div class="col-md-10">
                        <div class="col-md-6">
                            Nom : {{$user->nom}}
                        </div>
                        <div class="col-md-6">
                            Prénom : {{$user->prenom}}
                        </div>
                        <div class="col-md-6">
                            Né(e) le : {{ $user->naissance_at_show }}
                        </div>
                        <div class="col-md-6">
                            A : {{ $user->naissance_lieu }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <img src="{{ asset('storage/'.$user->photo) }}" alt="photo_profil" class="img-thumbnail">
                    </div>
                </div>
                <hr>
                <h4 class="card-title mb-3">Adresse </h4>
                <div class="row">
                    <div class="col-md-12">
                        Adresse : {{$user->adresse}}
                    </div>
                    <div class="col-md-6">
                        CP : {{$user->cp}}
                    </div>
                    <div class="col-md-6">
                        Ville : {{$user->ville}}
                    </div>
                </div>
                <hr>
                <h4 class="card-title mb-3">Coordonnées </h4>
                <div class="row">
                    <div class="col-md-6">
                        Telephone : {{$user->tel}}
                    </div>
                    <div class="col-md-6">
                        Email : {{$user->email}}
                    </div>
                </div>
                <hr>
                @can('secretariat')
                    <a href="{{ route('user.destroy',$user) }}"
                    onclick="event.preventDefault();
                    document.getElementById('delete-form-{{$user->id}}').submit();"
                    class="btn  btn-danger m-1 footer-delete-left">Supprimer l'adhérent</a>
                    <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy',$user) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                @endcan
                @can('edit-user', $user)
                    <a href="{{route('user.edit',$user)}}" class="btn  btn-warning m-1 footer-delete-right">Modifier les informations</a>
                @endcan

            </div>

        </div>
    </div>
</div>
@endsection
