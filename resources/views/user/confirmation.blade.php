@extends('layouts.app')

@section('content')

<div class="breadcrumb">
    <h1 class="mr-2">Gestion des adhérents</h1>
    <ul>
        <li><a href="">Confirmation suppression</a></li>
        <li>{{$user->nom}}</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">
    <div class="col-lg-4"></div>
    <div class="col-lg-4 mb-4">
        <div class="card text-left">
            <div class="card-header">
                <h3>{{$user->nom}} {{$user->prenom}}</h3>
                Voulez vous supprimer l'adhérent  ?

            </div>
            <div class="card-footer">
<a href="{{ route('user.destroy',$user) }}"
                    onclick="event.preventDefault();
                    document.getElementById('delete-form-{{$user->id}}').submit();"
                    class="btn  btn-danger m-1 footer-delete-left">Supprimer</a>
                    <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy',$user) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>

                    <button type="button" class="btn btn-outline-secondary m-1 footer-delete-right"  onclick="history.back()">Retour</button>
            </div>
        </div>
    </div>
</div>
@endsection
