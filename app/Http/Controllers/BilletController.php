<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

/**
 * Controlleur utilisé pour le modèle et les vues de l'exercice bonus
 * Class BilletController
 * @package App\Http\Controllers
 */
class BilletController extends Controller
{
    /**
     * @param Request $request
     * @return Vue affichant le résulat du bonus sur le fichier sélectionnée
     * Si aucun fichier mentionné, redirige sur la même page et affiche une erreur
     */
    public function afficheTabBillets(Request $request){
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
            $billet = new Billet();
            $billets = $billet->getTabBillets($file);
            $newFile = fopen(storage_path('app/bonus/resultat.json'), 'w+');
            fwrite($newFile, $billets);
            return view('bonus', ['tab_billets' => $billets,
                'erreur' => $erreur]);
        }
        else{
            $erreur = "Aucun fichier n'a été sélectionné! Veuillez sélectionner un fichier pour pouvoir afficher les transactions.";
            Session::put('erreur', $erreur);
            return redirect('/listerBonus');
        }
    }

    /**
     * Ajoute et stock le fichier sélectionné s'il n'existe pas déjà dans le répertoire bonus.
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
     * @param $fichier
     * @return bool indiquant si le fichier existe déjà ou non
     */
    private function verifieExistance($fichier){
        $fichiers = File::allFiles(storage_path('app/bonus'));
        foreach($fichiers as $file)
        {
            if(basename($file) === $fichier){
                return true;
            }
        }
        return false;
    }

    /**
     * Enregistre le fichier sélectionné à l'emplacement réservé
     * @param Request $request
     */
    private function upload(Request $request) {
        $this->validate($request, [
            'file' => 'mimes:json', //accepte uniquement les fichiers ".json"
        ]);

        $file = $request->file('fichier');
        $file->move(storage_path('app/bonus'), $file->getClientOriginalName());
    }

    /**
     * @return vue affichant le formulaire de sélection de fichier pour l'exercice bonus
     */
    public function afficheFormBillet(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $nomFichiers = File::allFiles(storage_path('app/bonus'));
        return view ('formBonus')->with([  'nomFichiers' => $nomFichiers,
            'erreur' => $erreur]);
    }

    /**
     * @return télechargement du fichier de réponse à l'exercice bonus
     */
    public function download(){
        $headers = array(
            'Content-Type: response/json',
        );
        return response()->download(storage_path('app/bonus/resultat.json'), 'response.json', $headers);
    }
}
