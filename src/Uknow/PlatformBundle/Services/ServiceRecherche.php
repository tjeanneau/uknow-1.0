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

    public function fichierDonneesRecherche($listStructure, $listDonnees){

        $fichier = fopen('json/donneesRecherche.json', 'w+');
        $donneesRecherche = array();
        $listDonnees = $this->affichage->affichageLien($listStructure, $listDonnees);

        for( $i = 0; $i < count($listDonnees); $i++){
            $donneeCaracteristiques = array();
            $donneeCaracteristiques['domaine'] = $listDonnees[$i]->getDomaine();
            $donneeCaracteristiques['matiere'] = $listDonnees[$i]->getMatiere();
            $donneeCaracteristiques['theme'] = $listDonnees[$i]->getTheme();
            $donneeCaracteristiques['chapitre'] = $listDonnees[$i]->getChapitre();
            $donneeCaracteristiques['titre'] = $listDonnees[$i]->getTitre();
            $donneeCaracteristiques['type'] = $listDonnees[$i]->getType();
            $donneesRecherche[$i] = $donneeCaracteristiques;
        }

        fputs($fichier, json_encode($donneesRecherche));
        fclose($fichier);
    }
}