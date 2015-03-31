<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 19/03/15
 * Time: 11:09
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller{

    public function autocompletionAction(Request $request){

        $donneesEnvoyee = array();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesModification = $this->container->get('uknow_platform.modification');
        $lettres = $request->query->get('lettres');

        if ($this->container->get('request')->isXmlHttpRequest()) {

            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();

            $listDonnees = $servicesModification->listAJour($listDonnees);
            $donneesEnvoyee = $servicesRecherche->donneesRecherche($listDonnees, $lettres);

        }

        $response = new Response(json_encode($donneesEnvoyee));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function enregistrementAction(Request $request){

        $listMatiere = null;
        $listNiveaux = null;
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesSauvegarde = $this->container->get('uknow_platform.sauvegarde');
        $servicesModification = $this->container->get('uknow_platform.modification');
        $id = $request->query->get('id');

        if ($this->container->get('request')->isXmlHttpRequest()) {

            $donnee = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->find($id);

            $compte = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowUtilisateurBundle:Compte')
                ->find($this->getUser()->getId());

            $em = $this->getDoctrine()->getManager();
            $servicesBoutons->boutonSauvegarder($donnee, $compte, $em);

            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();

            $listDonnees = $servicesModification->listAJour($listDonnees);
            $listMatiere = $servicesSauvegarde->matiereSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
            $listNiveaux = $servicesSauvegarde->niveauxSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
        }

        $donneesEnvoyee = $servicesSauvegarde->donneeLien($listMatiere, $listNiveaux);
        $response = new Response(json_encode($donneesEnvoyee));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function suppressionAction(Request $request){

        $listMatiere = null;
        $listNiveaux = null;
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesSauvegarde = $this->container->get('uknow_platform.sauvegarde');
        $servicesModification = $this->container->get('uknow_platform.modification');
        $id = $request->query->get('id');

        if ($this->container->get('request')->isXmlHttpRequest()) {

            $donnee = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->find($id);

            $compte = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowUtilisateurBundle:Compte')
                ->find($this->getUser()->getId());

            $em = $this->getDoctrine()->getManager();
            $servicesBoutons->boutonSupprimer($donnee, $compte, $em);

            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();
            $listDonnees = $servicesModification->listAJour($listDonnees);
            $listMatiere = $servicesSauvegarde->matiereSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
            $listNiveaux = $servicesSauvegarde->niveauxSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
        }

        $donneesEnvoyee = $servicesSauvegarde->donneeLien($listMatiere, $listNiveaux);
        $donneesEnvoyee = array('matiere' => $listMatiere, 'niveau' => $listNiveaux);
        $response = new Response(json_encode($donneesEnvoyee));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}