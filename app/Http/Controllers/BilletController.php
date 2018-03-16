<?php

namespace App\Http\Controllers;

use App\Models\Billet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;


class BilletController extends Controller
{
    //
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

            //Creation du fichier de download
            File::put($file, $billets);
            Session::put('file', $file);

            return view('bonus', ['tab_billets' => $billets,
                'erreur' => $erreur]);
        }
        else{
            $erreur = "Aucun fichier n'a été sélectionné! Veuillez sélectionner un fichier pour pouvoir afficher les transactions.";
            Session::put('erreur', $erreur);
            return redirect('/listerBonus');
        }


    }

    private function ajouteFichier(Request $request){
        $fichier = $request->input('chx_radio');
        if($fichier === "uploaded_file")
            $fichier = $request->file('fichier')->getClientOriginalName();

        // A ce stage fichier peut valoir : nom d'un fichier, null ou ""

        if(!$this->verifieExistance($fichier))
            $this->upload($request);
    }

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

    private function upload(Request $request) {
        $this->validate($request, [
            'file' => 'mimes:json', //accepte uniquement les fichiers ".json"
        ]);

        $file = $request->file('fichier');
        // image upload in this folder.
        $file->move(storage_path('app/bonus'), $file->getClientOriginalName());
    }

    public function afficheFormBillet(){
        $erreur = Session::get('erreur');
        Session::forget('erreur');
        $nomFichiers = File::allFiles(storage_path('app/bonus'));
        return view ('formBonus')->with([  'nomFichiers' => $nomFichiers,
            'erreur' => $erreur]);
    }

    public function download(){
        $file= Session::get('file');
        Session::forget('file');

        $headers = array(
            'Content-Type: response/json',
        );

        return Response::download($file, 'reponse.json', $headers);
    }
}
