<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    //
    public function afficheTransaction(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $transaction = new Transaction();
        $transactions = $transaction->getTransactions();
        return view('affichage')->with(['nbTransactions' => $transactions[0],
                                             'transactions' => $transactions[1],
                                             'erreur' => $erreur]);
    }
}
