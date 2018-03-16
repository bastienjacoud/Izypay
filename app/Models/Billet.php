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
        $result = json_encode(["result" => $res], JSON_PRETTY_PRINT);
        return $result;
        //return $this->indentationJson();
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

    private function indentationJson($json){
        /*
        $chaine = explode('},', $json);
        foreach ($chaine as $subchaine){
            if($subchaine === $json){
                //dump("test");
                return $subchaine;
            }
            else{
                $this->indentationJson($subchaine) . "\n";
            }
        }
        */
        return $this->prettyPrint($json);
    }

    private function prettyPrint( $json )
    {
        $result = '';
        $level = 0;
        $in_quotes = false;
        $in_escape = false;
        $ends_line_level = NULL;
        $json_length = strlen( $json );

        for( $i = 0; $i < $json_length; $i++ ) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if( $ends_line_level !== NULL ) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if ( $in_escape ) {
                $in_escape = false;
            } else if( $char === '"' ) {
                $in_quotes = !$in_quotes;
            } else if( ! $in_quotes ) {
                switch( $char ) {
                    case '}': case ']':
                    $level--;
                    $ends_line_level = NULL;
                    $new_line_level = $level;
                    break;

                    case '{': case '[':
                    $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                    $char = "";
                    $ends_line_level = $new_line_level;
                    $new_line_level = NULL;
                    break;
                }
            } else if ( $char === '\\' ) {
                $in_escape = true;
            }
            if( $new_line_level !== NULL ) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
        }

        return $result;
    }
}