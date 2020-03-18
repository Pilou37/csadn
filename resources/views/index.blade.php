@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Bienvenue sur l'interface de gestion des adhérents</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>


    <div class="row">
        @foreach ($activites as $activite)
        <div class="col-md-2">
            <div class="card card-icon mb-4">
                <div class="card-body text-center"><i class="i-Add-User"></i>
                    <p class="text-muted mt-2 mb-2">{{ $activite->nom }}</p>
                    <p class="lead text-22 m-0">{{ $activite->nb_adherents }}</p>
                </div>
            </div>
        </div>
        @endforeach

    </div>


@endsection
