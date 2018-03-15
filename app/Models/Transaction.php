<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Sodium\add;

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
        //$tab = ["ev1" => ["e1", "e2"], "ev2"];
        //count($tab['ev1']);
        $tmp =[];

        foreach ($json_data as $data){
            if(!array_key_exists($data->{'event_name'}, $tmp)){
                $tmp[$data->{'event_name'}] = [];
            }
            array_push($tmp[$data->{'event_name'}], $data);
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
     * @param $tab      Big tab
     * @param $element  ['event', size]
     */
    protected function insertInTab(&$tab, $element, $index) {
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
