@extends('layouts.app')

@section('content')
    <div class="breadcrumb">
        <h1 class="mr-2">Bienvenue sur l'interface de gestion des adhérents</h1>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-xl-3 offset-xl-2 col-md-6">
            <a href="{{ route('user.create') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-primary text-24 line-height-1 mb-2">Adhérer au club</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 offset-xl-2 col-md-6">
            <a href="{{ route('login') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Lock-User"></i>
                        <div class="content">
                            <p class="text-primary text-24 line-height-1 mb-2">Se connecter</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>


@endsection
