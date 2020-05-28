@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Demande de réinitialisation du mot de passe</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('postreset') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">Nom</label>

                            <div class="col-md-6">
                                <input id="nom" type="nom" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prenom" class="col-md-4 col-form-label text-md-right">Prenom</label>

                            <div class="col-md-6">
                                <input id="prenom" type="prenom" class="form-control @error('prenom') is-invalid @enderror" name="prenom" required autocomplete="prenom">

                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Réinitialiser mon mot de passe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <p>Le mot de passe réinitialisé sera envoyé à l'adresse mail qui correspond aux informations saisie.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
