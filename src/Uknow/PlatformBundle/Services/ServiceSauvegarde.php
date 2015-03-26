<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/03/15
 * Time: 09:48
 */

namespace Uknow\PlatformBundle\Services;


class ServiceSauvegarde {

    private $tri;

    public function __construct($tri){
        $this->tri = $tri;
    }

    public function matiereSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);

        $tableauMatiere = array();
        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            $tableauMatiere = $listDonnees[$i]->getMatiere();
        }
    }

    public function niveauxSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
    }

    public function tableauDonneesSauvegardees($listDonnees, $chaineSauvegardees){

        $tableauInfo = array();
        for($i = 0 ; $i < count($listDonnees) ; $i++ ){
            $tableauInfo[$i] = 0;
        }
        $tableauSauvegardees = explode('/', $chaineSauvegardees);
        for($i = 0 ; $i < count($listDonnees) ; $i++ ){
            for($j = 0 ; $j < count($tableauSauvegardees) ; $j++){
                if($listDonnees[$i]->getId() == $tableauSauvegardees[$j]){
                    $tableauInfo[$i] = 1;
                }
            }
        }
        return $tableauInfo;
    }
}