<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe utilisée pour le traitement métier de l'exercice principal
 * Class Transaction
 * @package App\Models
 */
class Transaction extends Model
{
    /**
     * Retourne sous forme de tableau la réponse à l'exerice principal
     * @param $checkbox_statut
     * @param $file
     * @return array
     */
    public function getTransactions($checkbox_statut, $file){
        $json_data = $this->lectJson($file);
        $tmp =[];
        foreach ($json_data as $data){
            if($checkbox_statut){
                if($data->{'status'} == true){
                    if(!array_key_exists($data->{'event_name'}, $tmp)){
                        $tmp[$data->{'event_name'}] = [];
                    }
                    array_push($tmp[$data->{'event_name'}], $data);
                }
            }
            else{
                if(!array_key_exists($data->{'event_name'}, $tmp)){
                    $tmp[$data->{'event_name'}] = [];
                }
                array_push($tmp[$data->{'event_name'}], $data);
            }
        }
        $maxis = [['', 0], ['', 0], ['', 0], ['', 0], ['', 0]];
        foreach ($tmp as $name => $subtab) {
            $taille = count($subtab);
            $actu = [$name, $taille];
            $this->insertInTab($maxis, $actu, 4);
        }
        $res = [
            $tmp[$maxis[0][0]],
            $tmp[$maxis[1][0]],
            $tmp[$maxis[2][0]],
            $tmp[$maxis[3][0]],
            $tmp[$maxis[4][0]]
        ];
        return $res;
    }

    /**
     * @return contenu du fichier json sélectionné
     */
    private function lectJson($file){
        $path = "app/objectif/" . basename($file);
        $json_source = file_get_contents(storage_path($path));

        return json_decode($json_source);
    }

    /**
     * Fonction récursive qui crée le tableau contenant les 5 maximums
     * @param $tab
     * @param $element
     * @param $index
     * @return mixed
     */
    private function insertInTab(&$tab, $element, $index) {
        if($element[1] > $tab[$index][1]) {
            $tmp = $tab[$index];
            if($index > 0) {
                $element = $this->insertInTab($tab, $element, $index - 1);
            }
            $tab[$index] = $element;
            $element = $tmp;
        }
        return $element;
    }
}
