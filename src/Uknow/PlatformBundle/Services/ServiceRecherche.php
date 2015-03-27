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

    public function donneesRecherche($listDonnees, $lettres){

        $donneesRecherche = null;
        $exist = false;

        for( $i = 0; $i < count($listDonnees); $i++) {

            $donneeCaracteristiques = array();
            $donneeCaracteristiques['domaine_nom'] = $listDonnees[$i]->getDomaineNom();
            $donneeCaracteristiques['matiere_nom'] = $listDonnees[$i]->getMatiereNom();
            $donneeCaracteristiques['theme_nom'] = $listDonnees[$i]->getThemeNom();
            $donneeCaracteristiques['chapitre_nom'] = $listDonnees[$i]->getChapitreNom();
            $donneeCaracteristiques['domaine_lien'] = $listDonnees[$i]->getDomaineLien();
            $donneeCaracteristiques['matiere_lien'] = $listDonnees[$i]->getMatiereLien();
            $donneeCaracteristiques['theme_lien'] = $listDonnees[$i]->getThemeLien();
            $donneeCaracteristiques['chapitre_lien'] = $listDonnees[$i]->getChapitreLien();
            $donneeCaracteristiques['titre'] = $listDonnees[$i]->getTitre();
            $donneeCaracteristiques['type'] = $listDonnees[$i]->getType();
            $donneeCaracteristiques['niveau'] = $listDonnees[$i]->getNiveau();

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
        }

        return $donneesRecherche;

    }

    public function affichageRecherche($listDonnees, $lettres){

        $donneesRecherche = array();

        for ($i = 0 ; $i < count($listDonnees) ; $i++){
            if(stripos($listDonnees[$i]->getDomaineNom(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getMatiereNom(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getThemeNom(), $lettres) === 0){
                $donneesRecherche[] = $listDonnees[$i];
            }elseif(stripos($listDonnees[$i]->getChapitreNom(), $lettres) === 0){
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