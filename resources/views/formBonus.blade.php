@extends('layouts.master')
@section('content')
    <div class="container" id="container_form_aff">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <form class="form-horizontal" action="{{ route('bonus') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table>
                        <div class="form-group">
                            @foreach($nomFichiers as $nomFichier)
                                <tr>
                                    <td>
                                        <p id="texte_formAff">{{ basename($nomFichier) }}</p>
                                    </td>
                                    <td>
                                        <input class="form-control" type="radio" name="chx_radio" id="btn_radio" value={{ basename($nomFichier) }}>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td id="texte_formAff">
                                    <input type="file" name="fichier" id="file">
                                </td>
                                <td>
                                    <input class="form-control" type="radio" name="chx_radio" value="uploaded_file" id="btn_radio" checked>
                                </td>
                            </tr>
                        </div>

                        <div class="form-group">
                            <tr>
                                <td>

                                </td>
                                <td class="col-xs-1">
                                    <button type="submit" class="btn btn-info btn-lg" value="btn_afficher">Afficher</button>
                                </td>
                            </tr>
                        </div>
                    </table>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
                <a href="{{ url('/') }}" class="btn btn-info btn-lg" id="btn_home">
                    <i class="fa fa-home"></i> Home
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs10 col-xs-offset-1">
                @include('error', ['erreur' => $erreur])
            </div>
        </div>
    </div>
@endsection