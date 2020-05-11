@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1 class="mr-2">Bienvenue sur l'interface de gestion des adhérents</h1>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row justify-content-center">
    @foreach ($activites as $activite)
    <div class="col-md-2">

        <div class="card card-icon mb-4">
            <div class="card-header text-center">{{ $activite->nom }}</div>
            <div class="card-body text-center"><i class="i-Add-User"></i><span class="lead text-22 ml-3">{{ $activite->nb_adherents }}</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection
