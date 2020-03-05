@extends('layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">Liste des adhérents</h4>
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

                                <td>
                                    <a class="text-success mr-2" href="{{route('user.edit',$user)}}"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
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
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
