<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 04/03/15
 * Time: 20:38
 */

namespace Uknow\PlatformBundle\Services;

use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Form\RechercheType;

class ServiceRecherche {

    private $affichage;
    private $modification;
    private $rechercher;

    public function __construct($affichage, $modification){
        $this->affichage = $affichage;
        $this->modification = $modification;
    }

    public function initialisationRecherche($thisController){

        $question = new FormulaireRechercher();
        $formQuestion = $thisController->get('form.factory')->create(new RechercheType(), $question);
        return $formQuestion;
    }

    public function donneesRecherche($listDonnees, $listStructure, $lettres){

        $donneesRecherche = null;
        $exist = false;

        for( $i = 0; $i < count($listDonnees); $i++) {

            if ($donneesRecherche == null) {
                $donneeCaracteristiques = array();
                $listDonnees = $this->affichage->correctionLien($listStructure, $listDonnees);

                $donneeCaracteristiques['domaineTitre'] = $listDonnees[$i]->getDomaine();
                $donneeCaracteristiques['matiereTitre'] = $listDonnees[$i]->getMatiere();
                $donneeCaracteristiques['themeTitre'] = $listDonnees[$i]->getTheme();
                $donneeCaracteristiques['chapitreTitre'] = $listDonnees[$i]->getChapitre();

                $listDonnees = $this->affichage->affichageLien($listStructure, $listDonnees);

                $donneeCaracteristiques['domaine'] = $listDonnees[$i]->getDomaine();
                $donneeCaracteristiques['matiere'] = $listDonnees[$i]->getMatiere();
                $donneeCaracteristiques['theme'] = $listDonnees[$i]->getTheme();
                $donneeCaracteristiques['chapitre'] = $listDonnees[$i]->getChapitre();
                $donneeCaracteristiques['titre'] = $listDonnees[$i]->getTitre();
                $donneeCaracteristiques['type'] = $listDonnees[$i]->getType();
                $donneeCaracteristiques['niveau'] = $listDonnees[$i]->getNiveau();

                if (stripos($donneeCaracteristiques['domaine'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['matiere'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['theme'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['chapitre'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['titre'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['type'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                } elseif (stripos($donneeCaracteristiques['niveau'], $lettres) === 0) {
                    $donneesRecherche = array();
                    $donneesRecherche[] = $donneeCaracteristiques;
                }
            } else {
                $donneeCaracteristiques = array();
                $listDonnees = $this->affichage->correctionLien($listStructure, $listDonnees);

                $donneeCaracteristiques['domaineTitre'] = $listDonnees[$i]->getDomaine();
                $donneeCaracteristiques['matiereTitre'] = $listDonnees[$i]->getMatiere();
                $donneeCaracteristiques['themeTitre'] = $listDonnees[$i]->getTheme();
                $donneeCaracteristiques['chapitreTitre'] = $listDonnees[$i]->getChapitre();

                $listDonnees = $this->affichage->affichageLien($listStructure, $listDonnees);

                $donneeCaracteristiques['domaine'] = $listDonnees[$i]->getDomaine();
                $donneeCaracteristiques['matiere'] = $listDonnees[$i]->getMatiere();
                $donneeCaracteristiques['theme'] = $listDonnees[$i]->getTheme();
                $donneeCaracteristiques['chapitre'] = $listDonnees[$i]->getChapitre();
                $donneeCaracteristiques['titre'] = $listDonnees[$i]->getTitre();
                $donneeCaracteristiques['type'] = $listDonnees[$i]->getType();
                $donneeCaracteristiques['niveau'] = $listDonnees[$i]->getNiveau();

                for ($j = 0; $j < count($donneesRecherche); $j++) {
                    if ($donneesRecherche[$j] == $donneeCaracteristiques) {
                        $exist = true;
                    }
                }

                if ($exist == false) {
                    if (stripos($donneeCaracteristiques['domaine'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['matiere'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['theme'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['chapitre'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['titre'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['type'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    } elseif (stripos($donneeCaracteristiques['niveau'], $lettres) === 0) {
                        $donneesRecherche[] = $donneeCaracteristiques;
                    }
                }
                $exist = false;
            }
        }

        return $donneesRecherche;

    }

    public function affichageRecherche($listDonnees, $lettres){

        $donneesRecherche = array();

        for ($i = 0 ; $i < count($listDonnees) ; $i++){
            if(stripos($listDonnees[$i]->getDomaine(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getMatiere(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getTheme(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getChapitre(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getTitre(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getType(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getNiveau(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }
        }

        return $donneesRecherche;
    }
}