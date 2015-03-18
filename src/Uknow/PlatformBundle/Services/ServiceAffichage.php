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
                if($listDonnees[$j]->getDomaine() == $listStructure[$i]->getDomaineLien()
                    && $listDonnees[$j]->getMatiere() == $listStructure[$i]->getMatiereLien()
                    && $listDonnees[$j]->getTheme() == $listStructure[$i]->getThemeLien()
                    && $listDonnees[$j]->getChapitre() == $listStructure[$i]->getChapitreLien()){
                        $listDonnees[$j]->setDomaine($listStructure[$i]->getDomaine());
                        $listDonnees[$j]->setMatiere($listStructure[$i]->getMatiere());
                        $listDonnees[$j]->setTheme($listStructure[$i]->getTheme());
                        $listDonnees[$j]->setChapitre($listStructure[$i]->getChapitre());
                }
            }
        }
        return $listDonnees;
    }


    public function correctionLien($listStructure, $listDonnees){
        for($i = 0; $i < count($listStructure) ; $i++ ){
            for($j = 0; $j < count($listDonnees) ; $j++ ){
                if($listDonnees[$j]->getDomaine() == $listStructure[$i]->getDomaine()
                    && $listDonnees[$j]->getMatiere() == $listStructure[$i]->getMatiere()
                    && $listDonnees[$j]->getTheme() == $listStructure[$i]->getTheme()
                    && $listDonnees[$j]->getChapitre() == $listStructure[$i]->getChapitre()){
                    $listDonnees[$j]->setDomaine($listStructure[$i]->getDomaineLien());
                    $listDonnees[$j]->setMatiere($listStructure[$i]->getMatiereLien());
                    $listDonnees[$j]->setTheme($listStructure[$i]->getThemeLien());
                    $listDonnees[$j]->setChapitre($listStructure[$i]->getChapitreLien());
                }
            }
        }
        return $listDonnees;
    }
}