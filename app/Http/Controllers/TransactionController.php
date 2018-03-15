<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * @return $this
     */
    public function afficheTransaction(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $transaction = new Transaction();
        $transactions = $transaction->getTransactions();
        //dump($transactions);
        return view('affichage')->with(['table_transactions' => value($transactions),
                                             'erreur' => $erreur]);
    }
}
