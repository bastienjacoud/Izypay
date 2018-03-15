<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function Sodium\add;

class Transaction extends Model
{
    //
    public function getTransactions(){
        $json_data = $this->lectJson();

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
     * @return mixed
     */
    private function lectJson(){
        $json_source = file_get_contents("../storage/data.json");

        return json_decode($json_source);
    }

    /**
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
