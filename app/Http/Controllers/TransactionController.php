<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

/**
 * Class TransactionController
 * @package App\Http\Controllers
 * Controlleur utilisé pour le modèle et les vues de l'exercice principal
 */
class TransactionController extends Controller
{
    /**
     * @param $fichier
     * @return bool indiquant si un fichier existe déjà dans le dossier de stockage
     */
    private function verifieExistance($fichier){
        $fichiers = File::allFiles(storage_path('app/objectif'));
        foreach($fichiers as $file) {
            if(basename($file) === $fichier){
                return true;
            }
        }
        return false;
    }

    /**
     * Fonction qui ajoute un fichier dans le répertoire de stockage s'il n'existe déjà pas
     * @param Request $request
     */
    private function ajouteFichier(Request $request){
        $fichier = $request->input('chx_radio');
        if($fichier === "uploaded_file")
            $fichier = $request->file('fichier')->getClientOriginalName();
        if(!$this->verifieExistance($fichier))
            $this->upload($request);
    }

    /**
     * @return vue affichant le résultat de l'exercice principal
     * Si aucun fichier n'a été sélectionné, redirige sur la même page et affiche un
     * message d'erreur
     */
    public function afficheTransaction(Request $request){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $file = $request->input('chx_radio');
        if($file === "uploaded_file"){
            if($request->file('fichier') !== null)
                $file = $request->file('fichier')->getClientOriginalName();
            else
                $file = null;
        }
        if($file !== "" && $file !== null){
            $this->ajouteFichier($request);

            $checkbox_statut = $request->input('check_statut') || 0;
            $transaction = new Transaction();
            $transactions = $transaction->getTransactions($checkbox_statut, $file);
            return view('affichage')->with(['table_transactions' => value($transactions),
                'erreur' => $erreur]);
        }
        else{
            $erreur = "Aucun fichier n'a été sélectionné! Veuillez sélectionner un fichier pour pouvoir afficher les transactions.";
            Session::put('erreur', $erreur);
            return redirect('/afficheTransaction');
        }
    }

    /**
     * @return vue affichant le formulaire de choix de fichier et de choix du traitement (avec ou sans statut=1)
     * pour l'exercice principal
     */
    public function afficheFormTransaction(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $nomFichiers = File::allFiles(storage_path('app/objectif'));
        return view ('formAffichage')->with([  'nomFichiers' => $nomFichiers,
                                                    'erreur' => $erreur]);
    }

    /**
     * Upload le fichier sélectionné et le stock dans le réperoire objectif de storage
     * @param Request $request
     */
    private function upload(Request $request) {
        $this->validate($request, [
            'file' => 'mimes:json', //accepte uniquement les fichiers ".json"
        ]);

        $file = $request->file('fichier');
        // image upload in this folder.
        $file->move(storage_path('app/objectif'), $file->getClientOriginalName());
    }
}
