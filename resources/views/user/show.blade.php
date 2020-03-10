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
            <div class="card-body">
                <h4 class="card-title mb-3">Profil de {{$user->nom}} {{$user->prenom}}</h4>
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
                    <a href="{{ route('user.destroy',$user) }}"
                        onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$user->id}}').submit();"
                        class="btn  btn-danger m-1 footer-delete-left">Supprimer l'adhérent</a>
                    <a href="{{route('user.edit',$user)}}" class="btn  btn-warning m-1 footer-delete-right">Modifier les informations</a>
                    <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy',$user) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>

            </div>

        </div>
    </div>
</div>
@endsection
