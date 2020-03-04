@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Striped rows</h4>
                <p>Use <code>.table-striped</code> to add zebra-striping to any table rowwithin the <code>&lt;tbody&gt;</code>.</p>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Activité</th>
                                <th scope="col">Telephone</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{$user->nom}}</th>
                                <td>{{$user->prenom}}</td>
                                <td>Musculation</td>
                                <td>{{$user->tel}}</td>
                                @if ($user->licence_at)
                                <td><span class="badge badge-success">OK</span></td>
                                @else
                                    @if ($user->validation_at)
                                    <td><span class="badge badge-warning">Attente sygelic</span></td>
                                    @else
                                    <td><span class="badge badge-danger">Attente validation</span></td>
                                    @endif
                                @endif

                                <td><a class="text-success mr-2" href="#"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a><a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
