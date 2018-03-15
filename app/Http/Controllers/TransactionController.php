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
    public function afficheTransaction(Request $request){
        $erreur = Session::get('erreur');
        Session::forget('erreur');

        $checkbox_statut = $request->input('check_statut') || 0;
        $transaction = new Transaction();
        $transactions = $transaction->getTransactions($checkbox_statut);

        return view('affichage')->with(['table_transactions' => value($transactions),
                                             'erreur' => $erreur]);
    }

    /**
     * @return $this
     */
    public function afficheFormTransaction(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        return view ('formAffichage')->with('erreur', $erreur);
    }
}
