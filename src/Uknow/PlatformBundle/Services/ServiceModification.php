<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 06/03/15
 * Time: 11:34
 */

namespace Uknow\PlatformBundle\Services;

class ServiceModification {

    private $evaluation;

    public function __construct($evaluation){
        $this->evaluation = $evaluation;
    }

    public function listAJour($listDonnees){

        $listModification = array();
        $exist = false;
        for($i = 0; $i < count($listDonnees); $i++){
            if($i == 0){
                $listModification[] = $listDonnees[$i];
            }
            for($j = 0; $j < count($listModification); $j++){
                if($listDonnees[$i]->getDomaineLien() == $listModification[$j]->getDomaineLien()
                    && $listDonnees[$i]->getMatiereLien() == $listModification[$j]->getMatiereLien()
                    && $listDonnees[$i]->getThemeLien() == $listModification[$j]->getThemeLien()
                    && $listDonnees[$i]->getChapitreLien() == $listModification[$j]->getChapitreLien()
                    && $listDonnees[$i]->getTitre() == $listModification[$j]->getTitre()){
                    if($this->evaluation->ratio($listDonnees[$i]) > $this->evaluation->ratio($listModification[$j])){
                        $listModification[$j] = $listDonnees[$i];
                    }elseif($this->evaluation->ratio($listDonnees[$i]) == $this->evaluation->ratio($listModification[$j])){
                        if($listModification[$j]->getDate() < $listDonnees[$i]->getDate()){
                            $listModification[$j] = $listDonnees[$i];
                        }
                    }
                    $exist = true;
                }
            }
            if($exist == false){
                $listModification[] = $listDonnees[$i];
            }
            $exist = false;
        }

        return $listModification;
    }

    public function idAJour($chaineId, $listDonnees){

        if ($chaineId == null){
            return null;
        }else{
            $tableauId = explode('/', $chaineId);
            for($i = 0; $i < count($tableauId); $i++){
                for($j = 0; $j < count($listDonnees); $j++){
                    if($tableauId[$i] == $listDonnees[$j]->getId()){
                        $tableauId[$i] = $this->donneeAJour($listDonnees[$j], $listDonnees)->getId();
                    }
                }
            }
            $chaineId = implode('/', $tableauId);
            return $chaineId;
        }
    }

    public function donneeAJour($donnee, $listDonnees){

        for($k = 0; $k < count($listDonnees) ; $k++){
            if($listDonnees[$k]->getDomaine() == $donnee->getDomaine()
                && $listDonnees[$k]->getMatiere() == $donnee->getMatiere()
                && $listDonnees[$k]->getTheme() == $donnee->getTheme()
                && $listDonnees[$k]->getChapitre() == $donnee->getChapitre()
                && $listDonnees[$k]->getTitre() == $donnee->getTitre()){
                if($this->evaluation->ratio($listDonnees[$k]) > $this->evaluation->ratio($donnee)){
                    $donnee = $listDonnees[$k];
                }elseif($this->evaluation->ratio($listDonnees[$k]) == $this->evaluation->ratio($donnee)){
                    if($donnee->getDate() < $listDonnees[$k]->getDate()){
                        $donnee = $listDonnees[$k];
                    }
                }
            }
        }
        return $donnee;
    }

}