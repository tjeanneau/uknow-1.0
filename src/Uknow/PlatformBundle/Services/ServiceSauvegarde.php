<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/03/15
 * Time: 09:48
 */

namespace Uknow\PlatformBundle\Services;


use Uknow\PlatformBundle\Classes\Structure;

class ServiceSauvegarde {

    private $tri;

    public function __construct($tri){
        $this->tri = $tri;
    }

    public function matiereSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $tableauMatiere = $this->tableauMatiere($listDonnees);

        return $tableauMatiere;
    }

    public function niveauxSauvegardees($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->tri->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $tableauNiveaux = $this->tableauNiveaux($listDonnees);

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

    public function tableauMatiere($listDonnees){

        $donnee = new Structure();
        $newTableau = array();
        $json = file_get_contents('json/domaines.json');
        $jsonDomaine = json_decode($json, true);
        $json = file_get_contents('json/matieres.json');
        $jsonMatiere = json_decode($json, true);
       for($k = 0 ; $k < count($listDonnees) ; $k++){
            for($i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++){
                 for($j = 0 ; $j < count($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']]) ; $j++){
                    if($listDonnees[$k]->getMatiereLien() == $jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']){
                        $donnee = new Structure();
                        $donnee->setLien($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']);
                        $donnee->setNom($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['nom']);
                        $newTableau[] = $donnee;
                    }
                }
            }
        }

        $newTableau = $this->tri->triDoublonStructure($newTableau);
        return $newTableau;
    }

    public function tableauNiveaux($listDonnees){

        $newTableau = array();
        $json = file_get_contents('json/niveaux.json');
        $jsonNiveaux = json_decode($json, true);
        for($i = 0 ; $i < count($jsonNiveaux['niveaux']) ; $i++){
            for( $j = 0 ; $j < count($listDonnees) ; $j++){
                if($jsonNiveaux['niveaux'][$i]['nom'] == $listDonnees[$j]->getNiveau()){
                    $donnee = new Structure();
                    $donnee->setLien($jsonNiveaux['niveaux'][$i]['lien']);
                    $donnee->setNom($jsonNiveaux['niveaux'][$i]['nom']);
                    $newTableau[] = $donnee;
                }
            }
        }

        $newTableau = $this->tri->triDoublonStructure($newTableau);
        return $newTableau;
    }
}