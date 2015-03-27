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

    public function triListDomaine($jsonDomaine){

        $listDomaine = array();

        for( $i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++ ){
            $structure = new Structure();
            $structure->setNom($jsonDomaine['domaine'][$i]['nom']);
            $structure->setLien($jsonDomaine['domaine'][$i]['lien']);
            $listDomaine[$i] = $structure;
        }

        return $listDomaine;
    }

    public function triListMatiere($listStructure, $domaine){

        $listMatiere = array();

        for( $i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++ ){
            $structure = new Structure();
            $structure->setNom($jsonDomaine['domaine'][$i]['nom']);
            $structure->setLien($jsonDomaine['domaine'][$i]['lien']);
            $listMatiere[$i] = $structure;
        }

        return $listMatiere;
    }

    public function triTheme($listStructure, $domaine, $matiere, $type){

        $listTheme = array('theme' => array(), 'lien' => array());
        $listThemeStructure = array();
        $i = 0;
        $k = 0;
        $exist = false;
        $lock = false;

        do {
            if($lock == true){$i++;}
            if ($listStructure[$i]->getMatiereLien() == $matiere && $listStructure[$i]->getDomaineLien() == $domaine){
                $listTheme['theme'][$k] = $listStructure[$i]->getTheme();
                $listTheme['lien'][$k] = $listStructure[$i]->getThemeLien();
                $listThemeStructure[$k] = $listStructure[$i];
            }
            $lock = true;
        }While(($listStructure[$i]->getMatiereLien() != $matiere
            || $listStructure[$i]->getDomaineLien() != $domaine)
            && $i < (count($listStructure)));

        if($i == (count($listStructure))){
            return null;
        }

        for ($i = 1 ; $i < (count($listStructure)); $i++ ) {
            for ($j = 0; $j < $k+1; $j++) {
                if ($listStructure[$i]->getThemeLien() == $listTheme['lien'][$j]) {
                    $exist = true;
                }
            }
            if ($exist == false && $listStructure[$i]->getMatiereLien() == $matiere && $listStructure[$i]->getDomaineLien() == $domaine) {
                $k++;
                $listTheme['theme'][$k] = $listStructure[$i]->getTheme();
                $listTheme['lien'][$k] = $listStructure[$i]->getThemeLien();
                $listThemeStructure[$k] = $listStructure[$i];
            }
            $exist = false;
        }

        if ($type == 'structure'){
            return $listThemeStructure;
        }elseif($type == 'tableau'){
            return $listTheme;
        }
        return null;
    }

    public function triChapitre($listStructure, $domaine, $matiere, $theme, $type){

        $listChapitre = array('chapitre' => array(), 'lien' => array());
        $listChapitreStructure = array();
        $i = 0;
        $k = 0;
        $exist = false;
        $lock = false;

        do {
            if($lock == true){$i++;}
            if ($listStructure[$i]->getThemeLien() == $theme
                && $listStructure[$i]->getMatiereLien() == $matiere
                && $listStructure[$i]->getDomaineLien() == $domaine){
                $listChapitre['chapitre'][$k] = $listStructure[$i]->getChapitre();
                $listChapitre['lien'][$k] = $listStructure[$i]->getChapitreLien();
                $listChapitreStructure[$k] = $listStructure[$i];
            }
            $lock = true;
        }While(($listStructure[$i]->getThemeLien() != $theme
            || $listStructure[$i]->getMatiereLien() != $matiere
            || $listStructure[$i]->getDomaineLien() != $domaine)
            && $i < (count($listStructure)));

        if($i == (count($listStructure))){
            return null;
        }

        for ($i = 1 ; $i < (count($listStructure)); $i++ ) {
            for ($j = 0; $j < $k+1; $j++) {
                if ($listStructure[$i]->getChapitreLien() == $listChapitre['lien'][$j]) {
                    $exist = true;
                }
            }
            if ($exist == false && $listStructure[$i]->getThemeLien() == $theme && $listStructure[$i]->getMatiereLien() == $matiere && $listStructure[$i]->getDomaineLien() == $domaine) {
                $k++;
                $listChapitre['chapitre'][$k] = $listStructure[$i]->getChapitre();
                $listChapitre['lien'][$k] = $listStructure[$i]->getChapitreLien();
                $listChapitreStructure[$k] = $listStructure[$i];
            }
            $exist = false;
        }

        if ($type == 'structure'){
            return $listChapitreStructure;
        }elseif($type == 'tableau'){
            return $listChapitre;
        }
        return null;
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

    public function triDonneesAfficher($listStructure, $listDonnees, $chaineDonnees, $newlistdonnees, $type, $action){

        $listDonnees = $this->modification->listAJour($listDonnees);

        if($type != 'boutonRecherche' && $type != 'boutonFavoris'){
           $listDonnees = $this->affichage->affichageLien($listStructure, $listDonnees);
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

    public function triDonneesList($listStructure, $listDonnee){

        $nombreDonnees = array();
        $aJourDonnees = array();
        $exist = false;

        for( $i = 0 ; $i < count($listStructure) ; $i++){
            $nombreDonnees[$i] = 0;
            for( $j = 0 ; $j < count($listDonnee) ; $j++){
                if($listStructure[$i]->getDomaineLien() == $listDonnee[$j]->getDomaine()
                && $listStructure[$i]->getMatiereLien() == $listDonnee[$j]->getMatiere()
                && $listStructure[$i]->getThemeLien() == $listDonnee[$j]->getTheme()
                && $listStructure[$i]->getChapitreLien() == $listDonnee[$j]->getChapitre()){
                    if($j == 0){
                        $aJourDonnees[] = $listDonnee[$j];
                    }
                    for($k = 0 ; $k < count($aJourDonnees); $k++){
                        if($aJourDonnees[$k]->getDomaine() == $listDonnee[$j]->getDomaine()
                        && $aJourDonnees[$k]->getMatiere() == $listDonnee[$j]->getMatiere()
                        && $aJourDonnees[$k]->getTheme() == $listDonnee[$j]->getTheme()
                        && $aJourDonnees[$k]->getChapitre() == $listDonnee[$j]->getChapitre()
                        && $aJourDonnees[$k]->getTitre() == $listDonnee[$j]->getTitre()){
                            $exist = true;
                        }
                    }
                    if($exist == false){
                        $aJourDonnees[] = $listDonnee[$j];
                        $nombreDonnees[$i] = $nombreDonnees[$i] + 1;
                    }
                    $exist = false;
                }
            }
        }
        return $nombreDonnees;
    }

    public function triDoublonsNoms($listNoms){

        $listNomsTriee = array();
        $exist = false;

        for($i = 0; $i < count($listNoms); $i++){
            if($i == 0){
                $listNomsTriee[] = $listNoms[$i];
            }else{
                for($j = 0; $j < count($listNomsTriee); $j++){
                    if($listNoms[$i] == $listNomsTriee[$j]){
                        $exist = true;
                    }
                }
                if( $exist == false)
                {
                    $listNomsTriee[] = $listNoms[$i];
                }
                $exist = false;
            }
        }
    }
}