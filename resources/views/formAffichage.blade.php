@extends('layouts.master')
@section('content')
<div class="container col-xs-6 col-lg-offset-3" id="affichage_cont">
    <form class="form-horizontal" action="{{ route('listerAffichage') }}" method="POST">
        {{ csrf_field() }}
        <table>
            <tr>
                <td>
                    <h2>Afficher uniquement les transaction dont le statut vaut 1 :&nbsp;&nbsp;</h2>
                </td>
                <td class="checkbok col-xs-1">
                    <input type="checkbox" id="checkbox1" name="check_statut" value=1>
                    <label for="checkbox1"></label>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td class="col-xs-1">
                    <button type="submit" class="btn btn-info btn-lg">Afficher</button>
                </td>
            </tr>
        </table>
        <a href="{{ url('/') }}" class="btn btn-info btn-lg" id="btn_home">
            <i class="fa fa-home"></i> Home
        </a>
    </form>
    <div class="col-md-6 col-md-offset-3">
        @include('error')
    </div>
</div>
@stop