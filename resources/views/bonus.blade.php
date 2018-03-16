@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div id="affichage_cont">
                <h1 class="bvn" id="titre_bonus"> Affichage de l'objet Json obtenu : </h1>
                <br><br>
                <pre>
                    {!!  $tab_billets !!}
                </pre>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-10">
                <a href="{{ url('/') }}" class="btn btn-info btn-lg">
                    <i class="fa fa-home"></i> Home
                </a>
            </div>
            <div class="col-xs-2">
                <a href="{{ url('/') }}" class="btn btn-info btn-lg">
                    <i class="fa fa-download"></i> Download
                </a>
            </div>
        </div>
    </div>
@endsection
