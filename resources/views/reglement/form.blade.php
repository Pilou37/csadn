@extends('layouts.app')

@section('content')
<div class="breadcrumb">

    @if ($reglement ?? '')
        <h1 class="mr-2">Gestion des règlements</h1>
        <ul>
            <li>{{ $user->nom }} {{ $user->prenom }}</li>
            <li>Modification</li>
        </ul>
    @else
        <h1 class="mr-2">Gestion des règlements</h1>
        <ul>
            <li>{{ $user->nom }} {{ $user->prenom }}</li>
            <li>Ajout</li>
        </ul>
    @endif
</div>
<div class="row">
    <div class="col-ml-6 mb-4">
        <div class="row">
            <div class="col-12">
                <!-- start card -->
                <div class="card">
                    <!--begin::form-->
                @if ($reglement ?? '')
                    <form action="{{route('reglement.update', $reglement)}}" method="POST" enctype="multipart/form-data">
                        @method('PATCH')
                @else
                    <form action="{{route('reglement.store')}}" method="POST" enctype="multipart/form-data">
                @endif
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="card-body">
                            <h4 class="card-title mb-3">@if ($reglement ?? '') Modification @else Ajout @endif d'un règlement </h4>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="recu_id" class="ul-form__label">N° reçu :</label>
                                    <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('recu_id') is-invalid" @enderror id="recu_id" value="{{old('recu_id', $reglement->recu_id ?? '')}}" placeholder="Nr reçu" data-cip-id="recu_id" name="recu_id">
                                    @error('recu_id')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('recu_id') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-6 ">
                                    <label for="mode" class="ul-form__label @error('mode') text-danger @enderror">Mode de règlement :  {{ $errors->first('mode') }}</label>
                                    <select class="form-control" name="mode">
                                        @if ($modes = \App\Mode::all())
                                        @if (old('mode_id'))
                                            <?php $mode_id = old('mode_id') ?>
                                        @elseif ($reglement->mode_id ?? '')
                                            <?php $mode_id = $reglement->mode_id ?>
                                        @else
                                            <?php $mode_id = 1 ?>
                                        @endif
                                        @foreach ($modes as $mode)
                                        <option value="{{$mode->id}}" @if ($mode_id == $mode->id) selected @endif>{{$mode->nom}}</option>
                                        @endforeach

                                    @else
                                        Aucun mode connue
                                    @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="valeur" class="ul-form__label">Valeur :</label>
                                    <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('valeur') is-invalid" @enderror id="valeur" value="{{old('valeur', $reglement->valeur ?? '')}}" placeholder="€" data-cip-id="valeur" name="valeur">
                                    @error('valeur')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('valeur') }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="mc-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" class="btn btn-outline-secondary m-1"  onclick="history.back()">Annuler</button>
                                        <button type="submit" class="btn m-1 footer-delete-right @if ($reglement ?? '') btn-warning">Modifier @else btn-success"> Ajouter @endif</button>
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
    <div class="col-ml-6 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Autres règlements</h4>
                @include('plugins.tab-reglements')
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/form.js') }}"></script>
@endsection
