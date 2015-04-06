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


    public function __construct($modification, $evaluation){
        $this->modification = $modification;
        $this->evaluation = $evaluation;
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

    public function findObjectLien($lien, $type, $domaine, $matiere, $theme){

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
        }elseif($type == 'niveau'){
            $json = file_get_contents('json/niveaux.json');
            $jsonNiveaux = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonNiveaux['niveaux']) ; $i++){
                if($structureLien->getLien() == $jsonNiveaux['niveaux'][$i]['lien']){
                    $structureLien->setNom($jsonNiveaux['niveaux'][$i]['nom']);
                    return $structureLien;
                }
            }
        }

        return null;
    }

    public function findObjectNom($nom, $type, $domaine, $matiere, $theme){

        $structureNom = new Structure();
        $structureNom->setNom($nom);

        if($type == 'domaine'){
            $json = file_get_contents('json/domaines.json');
            $jsonDomaine = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++ ){
                if($structureNom->getNom() == $jsonDomaine['domaine'][$i]['nom']){
                    $structureNom->setLien($jsonDomaine['domaine'][$i]['lien']);
                    return $structureNom;
                }
            }
        }elseif($type == 'matiere'){
            $json = file_get_contents('json/matieres.json');
            $jsonMatiere = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonMatiere['matiere'][$domaine]) ; $i++ ){
                if($structureNom->getNom() == $jsonMatiere['matiere'][$domaine][$i]['nom']){
                    $structureNom->setLien($jsonMatiere['matiere'][$domaine][$i]['lien']);
                    return $structureNom;
                }
            }
        }elseif($type == 'theme'){
            $json = file_get_contents('json/themes.json');
            $jsonTheme = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonTheme['theme'][$domaine][$matiere]) ; $i++ ){
                if($structureNom->getNom() == $jsonTheme['theme'][$domaine][$matiere][$i]['nom']){
                    $structureNom->setLien($jsonTheme['theme'][$domaine][$matiere][$i]['lien']);
                    return $structureNom;
                }
            }
        }elseif($type == 'chapitre'){
            $json = file_get_contents('json/chapitres.json');
            $jsonChapitre = json_decode($json, true);
            for( $i = 0 ; $i < count($jsonChapitre['chapitre'][$domaine][$matiere][$theme]) ; $i++ ){
                if($structureNom->getNom() == $jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['nom']){
                    $structureNom->setLien($jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['lien']);
                    return $structureNom;
                }
            }
        }

        return null;
    }

    public function findMatiereLien($lien){

        $json = file_get_contents('json/domaines.json');
        $jsonDomaine = json_decode($json, true);
        $json = file_get_contents('json/matieres.json');
        $jsonMatiere = json_decode($json, true);
        for($i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++){
            for($j = 0 ; $j < count($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']]) ; $j++){
                if($lien == $jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']){
                    $donnee = new Structure();
                    $donnee->setLien($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']);
                    $donnee->setNom($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['nom']);
                    return $donnee;
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
                if($domaine == $listDonnee[$j]->getDomaineLien()
                    && $matiere == $listDonnee[$j]->getMatiereLien()
                    && $theme == $listDonnee[$j]->getThemeLien()
                    && $jsonChapitre['chapitre'][$domaine][$matiere][$theme][$i]['lien'] == $listDonnee[$j]->getChapitreLien()){
                    $nombreDonnees[$i] = $nombreDonnees[$i]+1;
                }
            }
        }
        return $nombreDonnees;
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

    public function tableauDonneesSauvegardees($listDonnees, $chaineSauvegardees){

        $donneesSauvegardees = array();
        $tableauSauvegardees = explode('/', $chaineSauvegardees);
        for($i = 0 ; $i < count($listDonnees) ; $i++ ){
            $donneesSauvegardees[$i] = 0;
            for($j = 0 ; $j < count($tableauSauvegardees) ; $j++){
                if($listDonnees[$i]->getId() == $tableauSauvegardees[$j]){
                    $donneesSauvegardees[$i] = 1;
                }
            }
        }
        return $donneesSauvegardees;
    }

    public function donneesSauvegardees($donnee, $chaineSauvegardees){

        $tableauSauvegardees = explode('/', $chaineSauvegardees);
        for($j = 0 ; $j < count($tableauSauvegardees) ; $j++){
            if($donnee->getId() == $tableauSauvegardees[$j]){
                return true;
            }
        }
        return false;
    }

    public function triDonneesEvaluees($listDonneesAffichages, $chaineEvaluees){

        $tableauInfo = array();
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            $tableauInfo[$i] = 0;
        }
        $tableauEvaluees = explode('/', $chaineEvaluees);
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            for($j = 0 ; $j < count($tableauEvaluees) ; $j++){
                if(($listDonneesAffichages[$i]->getId() . '.1') == $tableauEvaluees[$j]){
                    $tableauInfo[$i] = 1;
                }elseif(($listDonneesAffichages[$i]->getId() . '.2') == $tableauEvaluees[$j]){
                    $tableauInfo[$i] = 2;
                }elseif(($listDonneesAffichages[$i]->getId() . '.3') == $tableauEvaluees[$j]){
                    $tableauInfo[$i] = 3;
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
            if ($listDonnees[$i]->getDomaineLien() == $donneeId->getDomaineLien()
                && $listDonnees[$i]->getMatiereLien() == $donneeId->getMatiereLien()
                && $listDonnees[$i]->getThemeLien() == $donneeId->getThemeLien()
                && $listDonnees[$i]->getChapitreLien() == $donneeId->getChapitreLien()
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

    public function triCours($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $listCours = array();

        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            if($listDonnees[$i]->getType() == 'Cours'){
                $listCours[] = $listDonnees[$i];
            }
        }

        return $listCours;
    }

    public function triExercice($listDonnees, $chaineSauvegardees){

        $listDonnees = $this->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $listExercice = array();

        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            if($listDonnees[$i]->getType() == 'Exercice'){
                $listExercice[] = $listDonnees[$i];
            }
        }

        return $listExercice;
    }

    public function triMatiere($listDonnees, $chaineSauvegardees, $matiere){

        $listDonnees = $this->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $listExercice = array();

        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            if($listDonnees[$i]->getMatiereLien() == $matiere){
                $listExercice[] = $listDonnees[$i];
            }
        }

        return $listExercice;
    }

    public function triNiveaux($listDonnees, $chaineSauvegardees, $niveau){

        $listDonnees = $this->triDonneesSauvegardees($listDonnees, $chaineSauvegardees);
        $listExercice = array();

        $json = file_get_contents('json/niveaux.json');
        $jsonNiveaux = json_decode($json, true);
        for( $i = 0 ; $i < count($jsonNiveaux['niveaux']) ; $i++){
            if($niveau == $jsonNiveaux['niveaux'][$i]['lien']){
                $niveau = new Structure();
                $niveau->setNom($jsonNiveaux['niveaux'][$i]['nom']);
                $niveau->setLien($jsonNiveaux['niveaux'][$i]['lien']);
            }
        }

        for( $i = 0 ; $i < count($listDonnees) ; $i++){
            if($listDonnees[$i]->getNiveauNom() == $niveau->getNom()){
                $listExercice[] = $listDonnees[$i];
            }
        }

        return $listExercice;
    }

    public function triDoublonStructure($list){

        $listri = array();
        $exist = false;
        for( $i = 0 ; $i < count($list) ; $i++){
            if($i == 0){
                $listri[] = $list[$i];
            }else{
                for( $j = 0 ; $j < count($listri) ; $j++){
                    if($listri[$j]->getNom() == $list[$i]->getNom() && $listri[$j]->getLien() == $list[$i]->getLien()){
                        $exist = true;
                    }
                }
                if($exist == false){
                    $listri[] = $list[$i];
                }
                $exist = false;
            }
        }

        return $listri;
    }
}