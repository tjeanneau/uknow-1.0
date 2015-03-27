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
    private $affichage;

    public function __construct($tri, $affichage){
        $this->tri = $tri;
        $this->affichage = $affichage;
    }

    public function matiereSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);

        $tableauMatiere = array();
        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            $tableauMatiere = $listDonnees[$i]->getMatiere();
        }
        $tableauMatiere = $this->tri->triDoublonsNoms($tableauMatiere);
        $tableauMatiere = $this->affichage->tableauNomLien($tableauMatiere);

        return $tableauMatiere;
    }

    public function niveauxSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);

        $tableauNiveaux = array();
        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            $tableauNiveaux = $listDonnees[$i]->getNiveau();
        }

        $tableauNiveaux = $this->tri->triDoublonsNoms($tableauNiveaux);
        $tableauNiveaux = $this->affichage->tableauNomLien($tableauNiveaux);

        return $tableauNiveaux;
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