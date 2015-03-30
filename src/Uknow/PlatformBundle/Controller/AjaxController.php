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

        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $id = $request->request->get('id');

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
        }

        return new Response();
    }

    public function suppressionAction(Request $request){

        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $id = $request->request->get('id');

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
        }

        return new Response();
    }
}