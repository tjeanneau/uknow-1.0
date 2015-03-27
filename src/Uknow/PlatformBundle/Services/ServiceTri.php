<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 20/02/15
 * Time: 13:47
 */

namespace Uknow\PlatformBundle\Services;

use Uknow\PlatformBundle\Classes\Structure;

class ServiceTri{

    private $modification;
    private $evaluation;
    private $affichage;

    public function __construct($modification, $evaluation, $affichage){
        $this->modification = $modification;
        $this->evaluation = $evaluation;
        $this->affichage = $affichage;
    }

    public function triListStructure($domaine, $matiere, $theme){

        $listStructure = array();

        if($domaine != null){
            if($matiere != null){
                if($theme != null){
                    $json = file_get_contents('json/chapitres.json');
                    $jsonChapitre = json_decode($json, true);
                    for( $i = 0 ; $i < count($jsonChapitre['chapitre'][$domaine][$matiere][$theme]) ; $i++ ){
                        $structure = new Structure();
                        $structure->setNom($jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['nom']);
                        $structure->setLien($jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['lien']);
                        $listStructure[$i] = $structure;
                    }
                }else{
                    $json = file_get_contents('json/themes.json');
                    $jsonTheme = json_decode($json, true);
                    for( $i = 0 ; $i < count($jsonTheme['theme'][$domaine][$matiere]) ; $i++ ){
                        $structure = new Structure();
                        $structure->setNom($jsonTheme['theme'][$domaine][$matiere][$i]['nom']);
                        $structure->setLien($jsonTheme['theme'][$domaine][$matiere][$i]['lien']);
                        $listStructure[$i] = $structure;
                    }
                }
            }else{
                $json = file_get_contents('json/matieres.json');
                $jsonMatiere = json_decode($json, true);
                for( $i = 0 ; $i < count($jsonMatiere['matiere'][$domaine]) ; $i++ ){
                    $structure = new Structure();
                    $structure->setNom($jsonMatiere['matiere'][$domaine][$i]['nom']);
                    $structure->setLien($jsonMatiere['matiere'][$domaine][$i]['lien']);
                    $listStructure[$i] = $structure;
                }
            }
        }else{
            $json = file_get_contents('json/domaines.json');
            $jsonDomaine = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++ ){
                $structure = new Structure();
                $structure->setNom($jsonDomaine['domaine'][$i]['nom']);
                $structure->setLien($jsonDomaine['domaine'][$i]['lien']);
                $listStructure[$i] = $structure;
            }
        }

        return $listStructure;
    }

    public function findObject($lien, $type, $domaine, $matiere, $theme){

        $structureLien = new Structure();
        $structureLien->setLien($lien);

        if($type == 'domaine'){
            $json = file_get_contents('json/domaines.json');
            $jsonDomaine = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++ ){
                if($structureLien->getLien() == $jsonDomaine['domaine'][$i]['lien']){
                    $structureLien->setNom($jsonDomaine['domaine'][$i]['nom']);
                    return $structureLien;
                }
            }
        }elseif($type == 'matiere'){
            $json = file_get_contents('json/matieres.json');
            $jsonMatiere = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonMatiere['matiere'][$domaine]) ; $i++ ){
                if($structureLien->getLien() == $jsonMatiere['matiere'][$domaine][$i]['lien']){
                    $structureLien->setNom($jsonMatiere['matiere'][$domaine][$i]['nom']);
                    return $structureLien;
                }
            }
        }elseif($type == 'theme'){
            $json = file_get_contents('json/themes.json');
            $jsonTheme = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonTheme['theme'][$domaine][$matiere]) ; $i++ ){
                if($structureLien->getLien() == $jsonTheme['theme'][$domaine][$matiere][$i]['lien']){
                    $structureLien->setNom($jsonTheme['theme'][$domaine][$matiere][$i]['nom']);
                    return $structureLien;
                }
            }
        }elseif($type == 'chapitre'){
            $json = file_get_contents('json/chapitres.json');
            $jsonChapitre = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonChapitre['chapitre'][$domaine][$matiere][$theme]) ; $i++ ){
                if($structureLien->getLien() == $jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['lien']){
                    $structureLien->setNom($jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['nom']);
                    return $structureLien;
                }
            }
        }

        return null;
    }

    public function triDonneesList($listDonnee, $domaine, $matiere, $theme){

        $nombreDonnees = array();
        $json = file_get_contents('json/chapitres.json');
        $jsonChapitre = json_decode($json, true);

        for( $i = 0 ; $i < count($jsonChapitre['chapitre'][$domaine][$matiere][$theme]) ; $i++){
            $nombreDonnees[$i] = 0;
            for( $j = 0 ; $j < count($listDonnee) ; $j++){
                if($domaine == $listDonnee[$j]->getDomaine()
                    && $matiere == $listDonnee[$j]->getMatiere()
                    && $theme == $listDonnee[$j]->getTheme()
                    && $jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['lien'] == $listDonnee[$j]->getChapitre()){
                    $nombreDonnees[$i] = $nombreDonnees[$i]+1;
                }
            }
        }
        return $nombreDonnees;
    }

    public function triTableau($listStructure){

        $domaines = $this->triDomaine($listStructure, 'tableau');
        for ( $i = 0; $i < (count($domaines['domaine'])); $i++){
            $matieres = $this->triMatiere($listStructure, $domaines['lien'][$i], 'tableau');
            for ( $j = 0; $j < (count($matieres['matiere'])); $j++){
                $themes = $this->triTheme($listStructure, $domaines['lien'][$i], $matieres['lien'][$j], 'tableau');
                for ( $k = 0; $k < (count($themes['theme'])); $k++){
                    $chapitres = $this->triChapitre($listStructure, $domaines['lien'][$i], $matieres['lien'][$j],$themes['lien'][$k], 'tableau');
                    for ( $l = 0; $l < (count($chapitres['chapitre'])); $l++){
                        $triTableau
                        [$domaines['domaine'][$i]]
                        [$matieres['matiere'][$j]]
                        [$themes['theme'][$k]]
                        [$chapitres['lien'][$l]]
                            = $chapitres['chapitre'][$l];
                    }
                }
            }
        }
        return $triTableau;
    }

    public function triDonneesAfficher( $listDonnees, $chaineDonnees, $newlistdonnees, $type, $action){

        $listDonnees = $this->modification->listAJour($listDonnees);

        if($type != 'boutonRecherche' && $type != 'boutonFavoris'){
           $listDonnees = $this->affichage->affichageLien( $listDonnees);
        }

        if($action == 'rechercher')
        {
           return $listDonnees;
        }elseif($chaineDonnees != null && ($type == 'favoris' || $type == 'boutonFavoris')){
            $tableauDonnees = explode('/', $chaineDonnees);
            for($j = 0; $j < count($listDonnees); $j++){
                for ($i = 0; $i < count($tableauDonnees); $i++) {
                    if ($listDonnees[$j]->getId() == $tableauDonnees[$i]) {
                        $newlistdonnees[] = $listDonnees[$j];
                    }
                }
            }

            return $newlistdonnees;
        }elseif ( $type == 'recherche' || $type == 'boutonRecherche') {
            return $listDonnees;
        }else{
            return null;
        }
    }

    public function triDonneesSauvegardees($listDonnees, $chaineSauvegardees){

        $donneesSauvegardees = array();
        $tableauSauvegardees = explode('/', $chaineSauvegardees);
        for($i = 0 ; $i < count($listDonnees) ; $i++ ){
            for($j = 0 ; $j < count($tableauSauvegardees) ; $j++){
                if($listDonnees[$i]->getId() == $tableauSauvegardees[$j]){
                    $donneesSauvegardees[] = $listDonnees[$i];
                }
            }
        }
        return $donneesSauvegardees;

    }

    public function triDonneesEvaluees($listDonneesAffichages, $chaineEvaluees){

        $tableauInfo = array();
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            $tableauInfo[$i] = 0;
        }
        $tableauEvaluees = explode('/', $chaineEvaluees);
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            for($j = 0 ; $j < count($tableauEvaluees) ; $j++){
                if(($listDonneesAffichages[$i]->getId() . '.0') == $tableauEvaluees[$j]){
                    $tableauInfo[$i] = 1;
                }elseif(($listDonneesAffichages[$i]->getId() . '.1') == $tableauEvaluees[$j]){
                    $tableauInfo[$i] = 2;
                }
            }
        }
        return $tableauInfo;
    }

    public function triDonneesModifiee($donneeId, $listDonnees){

        $k = 0;
        $tableauRatio = array();
        $listDonneesTriee = array();
        $newListDonneesTriee = array();
        for($i = 0 ; $i < count($listDonnees) ; $i++ ) {
            if ($listDonnees[$i]->getDomaine() == $donneeId->getDomaine()
                && $listDonnees[$i]->getMatiere() == $donneeId->getMatiere()
                && $listDonnees[$i]->getTheme() == $donneeId->getTheme()
                && $listDonnees[$i]->getChapitre() == $donneeId->getChapitre()
                && $listDonnees[$i]->getTitre() == $donneeId->getTitre()
            ) {
                $newListDonneesTriee[$k] = $listDonnees[$i];
                $k++;
            }
        }

        $k = 0;
        for($i = 0 ; $i < count($newListDonneesTriee) ; $i++ ){
            $tableauRatio[$i] = $this->evaluation->ratio($newListDonneesTriee[$i]);
        }
        rsort($tableauRatio);
        for($i = 0 ; $i < count($tableauRatio) ; $i++ ){
            for($j = 0 ; $j < count($newListDonneesTriee) ; $j++ ){
                if($tableauRatio[$i] == $this->evaluation->ratio($newListDonneesTriee[$j])){
                    $listDonneesTriee[$k] = $newListDonneesTriee[$j];
                    $k++;
                    unset($newListDonneesTriee[$j]);
                    $newListDonneesTriee = array_values($newListDonneesTriee);
                }
            }
        }

        return $listDonneesTriee;
    }
}