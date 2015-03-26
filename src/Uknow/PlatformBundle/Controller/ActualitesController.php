<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/03/15
 * Time: 17:28
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ActualitesController extends Controller{

    public function coursAction(Request $request){

    }

    public function exercicesAction(Request $request){

    }

    public function evaluationsAction(Request $request){

    }

    public function questionsAction(Request $request){

    }

    public function actualitesAction($action, Request $request)
    {

        // Initialisation des variables principales

        $newlistdonnees = array();
        $em = $this->getDoctrine()->getManager();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $recherche = new FormulaireRechercher();
        $formRecherche = $this->get('form.factory')->create(new RechercheType(), $recherche);


        // Initialisation des bases de données à utiliser

        if($action == 'actualites'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array(), array('date' => 'desc'), null, null);
        }elseif($action == 'mes_cours'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array('type' => 'Cours'), null, null, null);
        }elseif($action == 'mes_exercices'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array('type' => 'Exercice'), null, null, null);
        }elseif($action == 'rechercher'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();
        }

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonnees = $servicesTri->triDonneesAfficher($listStructure, $listDonnees, $compte->getDonneesSauvegardees(), $newlistdonnees, 'boutonFavoris', $action);


        // Gestion des requètes demandées

        if ($request->request->get('bouton', null) == 'Enlever') {
            $servicesBoutons->boutonEnlever($listStructure, $listDonnees, $compte, $request, $em);
        }

        if ($request->request->get('bouton', null) == 'Pertinent') {
            $servicesBoutons->boutonPertinent($listStructure, $listDonnees, $compte, $request, $em);
        }

        if ($request->request->get('bouton', null) == 'A développer') {
            $servicesBoutons->boutonDevelopper($listStructure, $listDonnees, $compte, $request, $em);
        }

        if ($formQuestion->handleRequest($request)->isValid()) {

        }

        if ($formRecherche->handleRequest($request)->isValid()){
            $listDonnees = $servicesRecherche->affichageRecherche($listDonnees, $recherche->getRecherche());
        }

        if ($request->request->get('bouton', null) == 'Modifier') {
            $donneeId = $listDonnees[$request->request->get('valeur', null) - 1]->getId();
            return $this->redirect($this->generateUrl('uknow_platform_modifier', array('id' => $donneeId)));
        }

        if ($request->request->get('bouton', null) == 'Modifications') {
            $donneeId = $listDonnees[$request->request->get('valeur', null) - 1]->getId();
            return $this->redirect($this->generateUrl('uknow_platform_modification', array('id' => $donneeId)));
        }


        // Mise à jour des bases de données modifiées à afficher

        if($action == 'actualites'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array(), array('date' => 'desc'), null, null);
        }elseif($action == 'mes_cours'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array('type' => 'Cours'), null, null, null);
        }elseif($action == 'mes_exercices'){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findBy(array('type' => 'Exercice'), null, null, null);
        }

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->findAll();


        // Gestion de l'affichage des données

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $listDonneesAffichage = $servicesTri->triDonneesAfficher($listStructure, $listDonneesAffichage, $compte->getDonneesSauvegardees(), $newlistdonnees, 'favoris', $action);
        $tableauInfoSauvegarde = $servicesTri->triDonneesSauvegardees($listDonneesAffichage, $compte->getDonneesSauvegardees());
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        if($action == 'actualites'){
            return $this->render('UknowPlatformBundle::actualites.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'listDonnees' => $listDonneesAffichage
            ));
        }elseif($action == 'mes_cours'){
            return $this->render('UknowPlatformBundle::cours.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'listDonnees' => $listDonneesAffichage
            ));
        }elseif($action == 'mes_exercices'){
            return $this->render('UknowPlatformBundle::exercices.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'listDonnees' => $listDonneesAffichage
            ));
        }elseif($action == 'rechercher'){
            return $this->render('UknowPlatformBundle::recherche.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion,
                'tableauSauvegarde' => $tableauInfoSauvegarde,
                'listDonnees' => $listDonneesAffichage
            ));
        }else{
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion));
        }
    }

}