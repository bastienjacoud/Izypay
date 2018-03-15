<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BilletController extends Controller
{
    //
    public function afficheTabBillets(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');

        $billet = new Billet();
        $billets = $billet->getTabBillets();

        return view('bonus')->with(['tab_billets' => $billets,
            'erreur' => $erreur]);
    }
}
