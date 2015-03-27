<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/03/15
 * Time: 10:27
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Services;
use Symfony\Component\HttpFoundation\Session\Session;

class NavigationController extends Controller{

    public function homeAction(){
        return $this->render('UknowPlatformBundle:navigation:home.html.twig');
    }

    public function rechercheAction(){

        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $formRecherche = $servicesRecherche->initialisationRecherche($this);

        return $this->render('UknowPlatformBundle:navigation:recherche.html.twig', array(
            'formRecherche' => $formRecherche->createView(),
        ));
    }

    public function lienAction(){

        $servicesSauvegarde = $this->container->get('uknow_platform.sauvegarde');
        $servicesModification = $this->container->get('uknow_platform.modification');

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        $listDonnees = $servicesModification->listAJour($listDonnees);

        $listMatiere = $servicesSauvegarde->matiereSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
        $listNiveaux = $servicesSauvegarde->niveauxSauvegardees($listDonnees, $compte->getDonneesSauvegardees());

        return $this->render('UknowPlatformBundle:navigation:lien.html.twig', array(
            'listMatiere' => $listMatiere,
            'nbMatiere' => count($listMatiere),
            'listNiveaux' => $listNiveaux,
            'nbNiveaux' => count($listMatiere),
        ));
    }

}