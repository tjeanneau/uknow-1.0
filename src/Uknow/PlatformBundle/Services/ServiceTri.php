<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 20/02/15
 * Time: 13:47
 */

namespace Uknow\PlatformBundle\Services;

class ServiceTri{

    private $modification;
    private $evaluation;
    private $affichage;

    public function __construct($modification, $evaluation, $affichage){
        $this->modification = $modification;
        $this->evaluation = $evaluation;
        $this->affichage = $affichage;
    }

    public function triDomaine($listStructure, $type){

        $listDomaine = array('domaine' => array(), 'lien' => array());
        $listDomaineStructure = array();
        $i = 0;
        $k = 0;
        $exist = false;

        $listDomaine['domaine'][$k] = $listStructure[$i]->getDomaine();
        $listDomaine['lien'][$k] = $listStructure[$i]->getDomaineLien();
        $listDomaineStructure[$k] = $listStructure[$i];
        for ($i = 1 ; $i < (count($listStructure)-1); $i++ ) {
            for ($j = 0; $j < $k+1; $j++) {
                if ($listStructure[$i]->getDomaineLien() == $listDomaine['lien'][$j]) {
                    $exist = true;
                }
            }
            if ($exist == false) {
                $k++;
                $listDomaine['domaine'][$k] = $listStructure[$i]->getDomaine();
                $listDomaine['lien'][$k] = $listStructure[$i]->getDomaineLien();
                $listDomaineStructure[$k] = $listStructure[$i];
            }
            $exist = false;

        }

        if ($type == 'structure'){
            return $listDomaineStructure;
        }elseif($type == 'tableau'){
            return $listDomaine;
        }
        return null;
    }

    public function triMatiere($listStructure, $domaine, $type){

        $listMatiere = array('matiere' => array(), 'lien' => array());
        $listMatiereStructure = array();
        $i = 0;
        $k = 0;
        $exist = false;
        $lock = false;

        do {
            if($lock == true){$i++;}
            if ($listStructure[$i]->getDomaineLien() == $domaine ){
                $listMatiere['matiere'][$k] = $listStructure[$i]->getMatiere();
                $listMatiere['lien'][$k] = $listStructure[$i]->getMatiereLien();
                $listMatiereStructure[$k] = $listStructure[$i];

            }
            $lock = true;
        }While($listStructure[$i]->getDomaineLien() != $domaine
            && $i < (count($listStructure)));

        if($i == (count($listStructure))){
            return null;
        }

        for ($i = 1 ; $i < (count($listStructure)); $i++ ) {
            for ($j = 0; $j < $k+1; $j++) {
                if ($listStructure[$i]->getMatiereLien() == $listMatiere['lien'][$j]) {
                    $exist = true;
                }
            }
            if ($exist == false && $listStructure[$i]->getDomaineLien() == $domaine) {
                $k++;
                $listMatiere['matiere'][$k] = $listStructure[$i]->getMatiere();
                $listMatiere['lien'][$k] = $listStructure[$i]->getMatiereLien();
                $listMatiereStructure[$k] = $listStructure[$i];
            }
            $exist = false;
        }

        if ($type == 'structure'){
            return $listMatiereStructure;
        }elseif($type == 'tableau'){
            return $listMatiere;
        }
        return null;
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

    public function triDonneesSauvegardees($listDonneesAffichages, $chaineSauvegardees){

        $tableauInfo = array();
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            $tableauInfo[$i] = 0;
        }
        $tableauSauvegardees = explode('/', $chaineSauvegardees);
        for($i = 0 ; $i < count($listDonneesAffichages) ; $i++ ){
            for($j = 0 ; $j < count($tableauSauvegardees) ; $j++){
                if($listDonneesAffichages[$i]->getId() == $tableauSauvegardees[$j]){
                    $tableauInfo[$i] = 1;
                }
            }
        }
        return $tableauInfo;
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
}