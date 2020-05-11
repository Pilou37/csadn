<div class="table-responsive">
    <table class="display table table-striped table-bordered" id="multicolumn_ordering_table" style="width:100%">
        <thead>
            <tr>
                <th>Nr reçu</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Mode</th>
                <th>Valeur</th>
                <th>Encaissé à</th>
                <th> --- </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reglements as $reglement)
            <tr>
                <td>{{$reglement->nr_recu}}</td>
                <td>@if ($reglement->user) {{$reglement->user->nom}} @else --------- @endif</td>
                <td>@if ($reglement->user) {{$reglement->user->prenom}} @else --------- @endif</td>
                <td>{{$reglement->mode->nom}}</td>
                <td>{{$reglement->valeur}}</td>
                <td>{{$reglement->encaissement_at}}</td>
                <td>
                    @if ($reglement->user) <a class="text-success mr-2" href="{{route('reglement.create',$reglement->user)}}"><i class="nav-icon i-Add font-weight-bold"></i></a>@endif
                    @if ($reglement->user)<a class="text-warning mr-2" href="{{route('reglement.edit',['user'=>$reglement->user,'reglement'=>$reglement])}}"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>@endif
                    <!--<a class="text-danger mr-2" href="#"><i class="nav-icon i-Close-Window font-weight-bold"></i></a></td>-->
                    <a class="text-danger mr-2" href="{{ route('reglement.destroy',$reglement) }}"
                                onclick="event.preventDefault();
                                document.getElementById('delete-form-{{$reglement->id}}').submit();"><i class="nav-icon i-Close-Window font-weight-bold"></i>
                    </a></td>
                    <form id="delete-form-{{$reglement->id}}" action="{{ route('reglement.destroy',$reglement) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
