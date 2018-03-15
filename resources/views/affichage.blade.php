@extends('layouts.master')
@section('content')
    <div class="container">
        <h1 class="bvn"> Affichage des 5 évênements avec le plus de transactions : </h1>
        &nbsp;
        @foreach($table_transactions as $transactions)
        <br><br>
        <h2>Cet évênement possède {{ count($transactions) }} transactions.</h2>
        &nbsp;
        <table class="table table-hover table-striped">
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
        </table>
        @endforeach
        &nbsp;
        <a href="{{ url('/') }}" class="btn btn-info btn-lg">
            <i class="fa fa-home"></i> Home
        </a>
    </div>
@stop