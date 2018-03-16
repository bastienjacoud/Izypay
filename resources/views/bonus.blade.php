@extends('layouts.master')
@section('content')
    <div class="container row">
        <div class="col-xs-8 col-xs-offset-2" id="affichage_cont">
            <h1 class="bvn"> Affichage de l'objet Json obtenu : </h1>
            <br><br>
            <div>
                {!! $tab_billets !!}
            </div>
            <div class="col-md-6 col-md-offset-3">
                @include('error')
            </div>
        </div>
    </div>
@endsection
