@extends('layouts.master')
@section('content')
    <div class="container">
        <h1 class="bvn"> Affichage des 5 évênements avec le plus de transactions : </h1>
        &nbsp;
        <table class="table table-hover">
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
            @foreach($transactions as $transaction)
                <tr>
                    <td>
                        {{ $transaction->event_name }}
                    </td>
                    <td>
                        {{ $nbTransactions }}
                    </td>
                    <td>
                        {{ $transaction->merchant }}
                    </td>
                    <td>
                        {{ $transaction->terminal }}
                    </td>
                    <td>
                        {{ $transaction->status }}
                    </td>
                    <td>
                        {{ $transaction->card_id }}
                    </td>
                    <td>
                        {{ $transaction->card_type }}
                    </td>
                    <td>
                        {{ $transaction->amount }}
                    </td>
                    <td>
                        {{ $transaction->currency }}
                    </td>
                    <td>
                        {{ $transaction->country }}
                    </td>
                    <td>
                        {{ $transaction->created }}
                    </td>
                </tr>
            @endforeach
        </table>
        &nbsp;
        <a href="{{ url('/') }}" class="btn btn-info btn-lg">
            <i class="fa fa-home"></i> Home
        </a>
    </div>
@stop