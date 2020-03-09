@extends('layouts.app')

@section('content')
<div class="breadcrumb">
    <h1 class="mr-2">Gestion des adhérents</h1>
    <ul>
        <li><a href="">Liste des adhérents</a></li>
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
            <p>DataTables allows ordering by multiple columns at the same time, which can be activated in a number of different ways</p>
            <div class="table-responsive">
                <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Activité</th>
                            <th>Telephone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->nom}}</td>
                            <td>{{$user->prenom}}</td>
                            <td>{{$user->activite->nom}}</td>
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

                            <td>
                                <a class="text-success mr-2" href="{{route('user.show',$user)}}"><i class="nav-icon i-ID-2 font-weight-bold"></i></a>
                                <a class="text-warning mr-2" href="{{route('user.edit',$user)}}"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                <!--<a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>-->
                                <a class="text-danger mr-2" href="{{ route('user.destroy',$user) }}"
                                            onclick="event.preventDefault();
                                            document.getElementById('delete-form-{{$user->id}}').submit();"><i class="nav-icon i-Close-Window font-weight-bold"></i>
                                </a></td>
                                <form id="delete-form-{{$user->id}}" action="{{ route('user.destroy',$user) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Activité</th>
                            <th>Telephone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
