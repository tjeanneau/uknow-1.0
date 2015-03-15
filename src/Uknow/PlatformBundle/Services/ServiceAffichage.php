<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 07/03/15
 * Time: 17:57
 */

namespace Uknow\PlatformBundle\Services;

class ServiceAffichage {

    public function affichageLien($listStructure, $listDonnees){
        for($i = 0; $i < count($listStructure) ; $i++ ){
            for($j = 0; $j < count($listDonnees) ; $j++ ){
                if($listDonnees[$j]->getMatiere() == $listStructure[$i]->getMatiereLien()){
                    $listDonnees[$j]->setMatiere($listStructure[$i]->getMatiere());
                }
            }
        }
        return $listDonnees;
    }

    public function correctionLien($listStructure, $listDonnees){
        for($i = 0; $i < count($listStructure) ; $i++ ){
            for($j = 0; $j < count($listDonnees) ; $j++ ){
                if($listDonnees[$j]->getMatiere() == $listStructure[$i]->getMatiere()){
                    $listDonnees[$j]->setMatiere($listStructure[$i]->getMatiereLien());
                }
            }
        }
        return $listDonnees;
    }
}