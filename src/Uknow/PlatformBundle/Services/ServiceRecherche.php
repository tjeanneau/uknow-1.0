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

    public function __construct( $affichage){
        $this->affichage = $affichage;
    }

    public function initialisationRecherche($thisController){

        $recherche = new FormulaireRechercher();
        $formRecherche = $thisController->get('form.factory')->create(new RechercheType(), $recherche);
        return $formRecherche;
    }

    public function donneesRecherche($listDonnees, $listStructure, $lettres){

        $donneesRecherche = array();

        for( $i = 0; $i < count($listDonnees); $i++){

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

            if(stripos($donneeCaracteristiques['domaine'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['matiere'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['theme'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['chapitre'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['titre'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['type'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }elseif(stripos($donneeCaracteristiques['niveau'], $lettres) === 0){
                $donneesRecherche[] = $donneeCaracteristiques;
            }
        }

        return $donneesRecherche;

    }
}