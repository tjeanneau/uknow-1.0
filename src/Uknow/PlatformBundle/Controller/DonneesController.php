<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 24/02/15
 * Time: 11:50
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Entity\Question;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Form\QuestionType;
use Symfony\Component\HttpFoundation\Session\Session;
use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Form\RechercheType;

class DonneesController extends Controller
{
    public function rechercheAction($domaine, $matiere, $theme, $chapitre, Request $request)
    {

        // Initialisation des variables principales

        $k = 0;
        $session = new Session();
        $newlistdonnees = array();
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);


        // Vérification de la session

        if ($session->get('identifiant', null) == null){
            return $this->redirect($this->generateUrl('uknow_connexion'));
        }


        // Initialisation des bases de données à utiliser

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findBy(array(
                'domaine' => $domaine,
                'matiere' => $matiere,
                'theme' => $theme,
                'chapitre' => $chapitre
            ), null, null, null);

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonnees = $servicesTri->triDonneesAfficher($listStructure, $listDonnees, $compte->getDonneesSauvegardees(), $newlistdonnees, 'boutonRecherche');


        // Gestion des requètes demandées

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if($request->request->get('bouton', null) == 'Enregistrer' || $request->request->get('bouton', null) == 'Suivre'){
            $servicesBoutons->boutonSauvegarder($listStructure, $listDonnees, $compte, $request, $em);
        }

        if ($request->request->get('bouton', null) == 'Pertinent') {
            $servicesBoutons->boutonPertinent($listStructure,$listDonnees, $compte, $request, $em);
        }

        if ($request->request->get('bouton', null) == 'A développer') {
            $servicesBoutons->boutonDevelopper($listStructure,$listDonnees, $compte, $request, $em);
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

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findBy(array(
                'domaine' => $domaine,
                'matiere' => $matiere,
                'theme' => $theme,
                'chapitre' => $chapitre
            ), null, null, null);

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->findAll();


        // Gestion de l'affichage des données

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $listDonneesAffichage = $servicesTri->triDonneesAfficher($listStructure, $listDonneesAffichage, $compte->getDonneesSauvegardees(), $newlistdonnees, 'recherche');
        $tableauInfoSauvegarde = $servicesTri->triDonneesSauvegardees($listDonneesAffichage, $compte->getDonneesSauvegardees());
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        for ($i = 0; $i < count($listStructure); $i++) {
            if ($listStructure[$i]->getChapitreLien() == $chapitre
                && $listStructure[$i]->getThemeLien() == $theme
                && $listStructure[$i]->getMatiereLien() == $matiere
                && $listStructure[$i]->getDomaineLien() == $domaine
            ){
                $k = $i;
            }
        }

        return $this->render('UknowPlatformBundle::donnees.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'titreDomaine' => $listStructure[$k]->getDomaine(),
            'titreMatiere' => $listStructure[$k]->getMatiere(),
            'titreTheme' => $listStructure[$k]->getTheme(),
            'titreChapitre' => $listStructure[$k]->getChapitre(),
            'domaine' => $domaine,
            'matiere' => $matiere,
            'theme' => $theme,
            'chapitre' => $chapitre,
            'listQuestion' => $listQuestion,
            'listStructure' => $listStructure,
            'listDonnees' => $listDonneesAffichage,
            'tableauSauvegarde' => $tableauInfoSauvegarde,
            'tableauEvaluation' => $tableauInfoEvaluation,
        ));
    }

    public function favorisAction($action, Request $request)
    {

        // Initialisation des variables principales

        $session = new Session();
        $newlistdonnees = array();
        $em = $this->getDoctrine()->getManager();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);



        //Vérification de la session

        if ($session->get('identifiant', null) == null) {
            return $this->redirect($this->generateUrl('uknow_connexion'));
        }


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
        }else{
            $listDonnees = null;
        }

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonnees = $servicesTri->triDonneesAfficher($listStructure, $listDonnees, $compte->getDonneesSauvegardees(), $newlistdonnees, 'boutonFavoris');


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
        }else{
            $listDonnees = null;
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
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->findAll();


        // Gestion de l'affichage des données

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $listDonneesAffichage = $servicesTri->triDonneesAfficher($listStructure, $listDonneesAffichage, $compte->getDonneesSauvegardees(), $newlistdonnees, 'favoris');
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
        }else{
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'formRecherche' => $formRecherche->createView(),
                'listQuestion' => $listQuestion));
        }
    }

    public function modificationsAction($id, Request $request)
    {

        // Initialisation des variables principales

        $k = 0;
        $session = new Session();
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesBoutons = $this->container->get('uknow_platform.boutons');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);


        // Vérification de la session

        if ($session->get('identifiant', null) == null){
            return $this->redirect($this->generateUrl('uknow_connexion'));
        }


        // Initialisation des bases de données à utiliser

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $donneeId = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findAll();

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $listDonnees = $servicesTri->triDonneesModifiee($donneeId, $listDonnees);


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        if ($request->request->get('bouton', null) == 'Modifier') {
            $id = $listDonnees[$request->request->get('valeur', null) - 1]->getId();
            return $this->redirect($this->generateUrl('uknow_platform_modifier', array('id' => $id)));
        }

        if ($request->request->get('bouton', null) == 'Pertinent') {
            $servicesBoutons->boutonPertinent($listStructure, $listDonnees, $compte, $request, $em);
        }

        if ($request->request->get('bouton', null) == 'A développer') {
            $servicesBoutons->boutonDevelopper($listStructure, $listDonnees, $compte, $request, $em);
        }


        // Mise à jour des bases de données modifiées à afficher

        $donneeId = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findAll();

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->find($session->get('identifiant', null));

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Compte')
            ->findAll();


        // Gestion de l'affichage des données

        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $listDonneesAffichage = $servicesTri->triDonneesModifiee($donneeId, $listDonneesAffichage);
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        for ($i = 0; $i < count($listStructure); $i++) {
            if ($listStructure[$i]->getChapitreLien() == $donneeId->getChapitre()
                && $listStructure[$i]->getThemeLien() == $donneeId->getTheme()
                && $listStructure[$i]->getMatiereLien() == $donneeId->getMatiere()
                && $listStructure[$i]->getDomaineLien() == $donneeId->getDomaine()
            ){
                $k = $i;
            }
        }

        return $this->render('UknowPlatformBundle::modifications.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'listQuestion' => $listQuestion,
            'listDonnees' => $listDonneesAffichage,
            'id' => $id,
            'titreDomaine' => $listStructure[$k]->getDomaine(),
            'titreMatiere' => $listStructure[$k]->getMatiere(),
            'titreTheme' => $listStructure[$k]->getTheme(),
            'titreChapitre' => $listStructure[$k]->getChapitre(),
            'tableauEvaluation' => $tableauInfoEvaluation,
        ));
    }
}