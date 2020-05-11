@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1 class="mr-2">Gestion des adhérents</h1>
    <ul>
        <li><a href="">Liste des règlements</a></li>
        <li>Saison 2019/20</li>
        <li>Aucun filtre</li>
    </ul>
</div>
<div class="separator-breadcrumb border-top"></div>
<div class="row mb-4">


<div class="col-md-12 mb-4">
    <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title mb-3">Multi-column ordering</h4>
            @include('plugins.tab-reglements')
        </div>
    </div>
</div>
</div>
@endsection
