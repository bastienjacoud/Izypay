<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Response;

class Billet extends Model
{
    //
    public function getTabBillets()
    {
        $json_data = $this->lectJson();

        $nbImpressions = ceil(count($json_data) / 6000);
        $impressions = array_chunk($json_data, 6000);
        $res = [];

        $index = 0;
        while ($index<$nbImpressions) {
            $this->realiseImpression($res, $impressions[$index], $index);
            $index ++;
        }

        return json_encode(array("result" => $res), JSON_PRETTY_PRINT);
    }

    /**
     * @return mixed
     */
    private function lectJson()
    {
        $json_source = file_get_contents("../storage/data_bonus.json");

        return json_decode($json_source);
    }

    private function realiseImpression(&$tabRes, $tabDonnees, $indImpression)
    {
        //On initialise tous nos tableaux
        $tabFeuilles = [];

        for ($i = 0; $i < 400; $i++) {
            $tabFeuilles[$i] = [];
        }

        foreach ($tabDonnees as $data) {
            $numFichier = ($data->{'num'}-6000*$indImpression) % 400;
            if ($numFichier === 0) {
                $numFichier = 399;
            } else {
                $numFichier--;
            }
            array_push($tabFeuilles[$numFichier], $data);
        }
        array_push($tabRes, array_collapse($tabFeuilles));
    }
}