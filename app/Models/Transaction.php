<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    public function getTransactions(){
        // Si les données json sont dans un fichier distant:
        //$json_source = file_get_contents('http://...../fichier.json');

        // Si les données json sont dans une variable sans passer par un fichier distant:
        $json_source = file_get_contents("../storage/data.json");

        // Décode le JSON
        $json_data = json_decode($json_source);

        $res =[];
        foreach ($json_data as $data){
            if($res[0].contains($data->{'event_name'})){
                
            }
        }

        $res = ['1', $json_data];
        return $res;
    }
}
