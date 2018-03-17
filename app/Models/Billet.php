<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe utilisée pour le traitement métier de l'exercice bonus
 * Class Billet
 * @package App\Models
 */
class Billet extends Model
{
    /**
     * @param $file
     * @return string correspondant à l'objet json que l'on obtient en réponse de l'exerice bonus
     */
    public function getTabBillets($file){
        $json_data = $this->lectJson($file);
        $nbImpressions = ceil(count($json_data) / 6000);
        $impressions = array_chunk($json_data, 6000);
        $res = [];
        $index = 0;
        while ($index<$nbImpressions) {
            $this->realiseImpression($res, $impressions[$index], $index);
            $index ++;
        }
        $result = json_encode(["result" => $res], JSON_PRETTY_PRINT);
        return $result;
    }

    /**
     * @return lit un fichier json et retourne son contenu
     */
    private function lectJson($file)
    {
        $path = "app/bonus/" . basename($file);
        $json_source = file_get_contents(storage_path($path));
        return json_decode($json_source);
    }

    /**
     * Réalise le traitement métier pour obtenir la réponse pour chaque
     * paquet de 6000 ( 15*400) billets
     * @param $tabRes
     * @param $tabDonnees
     * @param $indImpression
     */
    private function realiseImpression(&$tabRes, $tabDonnees, $indImpression)
    {
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