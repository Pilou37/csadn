@if ($message = Session::get('success'))
<div class="row">
    <div class="col">
        <div class="alert alert-card alert-success" role="alert"><strong class="text-capitalize">{{ $message }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="row">
    <div class="col">
        <div class="alert alert-card alert-danger text-center" role="alert"><strong>{{ $message }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="row">
    <div class="col">
        <div class="alert alert-card alert-warning" role="alert"><strong class="text-capitalize">{{ $message }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
@endif

@if ($message = Session::get('info'))
<div class="row">
    <div class="col">
        <div class="alert alert-card alert-info" role="alert"><strong class="text-capitalize">{{ $message }}</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
@endif

@if ($errors->any())
<?php dd($errors) ?>
<div class="row">
    <div class="col">
        <div class="alert alert-card alert-danger" role="alert"><strong class="text-capitalize">Merci de vérifier les erreurs</strong>
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    </div>
</div>
@endif
