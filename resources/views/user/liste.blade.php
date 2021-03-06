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
                        @if ($users[0]->id)
                        @foreach ($users as $user)

                        <tr>
                            <td>{{$user->nom}}</td>
                            <td>{{$user->prenom}}</td>
                            <td>{{$user->activite->nom}}</td>
                            <td>{{$user->tel}}</td>
                            <?php $status = $user->getSouscribeStatus() ?>
                            <td><span class="badge badge-{{$status["class"]}}">{{$status["mess"]}}</span></td>
                            <td>
                                <a class="text-success mr-2" href="{{route('user.show',$user)}}"><i class="nav-icon i-ID-2 font-weight-bold"></i></a>
                                <a class="text-warning mr-2" href="{{route('user.edit',$user)}}"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                <!--<a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>-->
                                @can('secretariat')
                                <a class="text-danger mr-2" href="{{route('user.confirmation',$user)}}" ><i class="nav-icon i-Close-Window font-weight-bold"></i></a>
                                @endcan
                                @can('comptabilite', $user)
                                <a class="text-success mr-2" href="{{route('reglement.create',$user->id)}}"><i class="nav-icon i-Coins font-weight-bold"></i></a>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="6">Aucun adhérent correspondant</td>
                        </tr>
                        @endif
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
