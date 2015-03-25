<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/03/15
 * Time: 16:31
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller{

    public function compteAction(Request $request)
    {

        // Initialisation des variables principales

        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);


        // Initialisation des bases de données à utiliser


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()) {

        }

        if ($formRecherche->handleRequest($request)->isValid()) {

        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $profil = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());


        // Gestion de l'affichage des données

        return $this->render('UknowPlatformBundle::compte.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'listQuestion' => $listQuestion,
            'profil' => $profil
        ));
    }
}