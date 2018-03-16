@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row" id="titre_aff">
        <h1 class="bvn col-xs-12"> Affichage des 5 évênements avec le plus de transactions : </h1>
    </div>
    <div id="table_transactions">
        @foreach($table_transactions as $transactions)
            <div class="row">
                <br><br>
                <h2 id="soustitre_tab">Cet évênement possède {{ count($transactions) }} transactions.</h2>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>
                                Nom
                            </th>
                            <th>
                                Nombre de transactions
                            </th>
                            <th>
                                Marchand
                            </th>
                            <th>
                                Terminal
                            </th>
                            <th>
                                Statut
                            </th>
                            <th>
                                ID Carte
                            </th>
                            <th>
                                Type Carte
                            </th>
                            <th>
                                Montant
                            </th>
                            <th>
                                Monnaie
                            </th>
                            <th>
                                Pays
                            </th>
                            <th>
                                Date de création
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(value($transactions) as $transaction)
                            <tr>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->event_name) }}
                                </td>
                                <td>
                                    {{ count($transactions) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->merchant) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->terminal) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->status) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->card_id) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->card_type) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->amount) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->currency) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->country) }}
                                </td>
                                <td>
                                    {{ str_replace(' ', "&nbsp;", $transaction->created) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <a href="{{ url('/') }}" class="btn btn-info btn-lg">
            <i class="fa fa-home"></i> Home
        </a>
    </div>
</div>
@endsection