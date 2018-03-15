@extends('layouts.master')
@section('content')
    <div class="container col-xs-6 col-lg-offset-3" id="affichage_cont">
        <h1 class="bvn"> Affichage de l'objet Json obtenu : </h1>
        <br><br>
        <h2>
            {{ $tab_billets }}
        </h2>
    </div>
@stop
