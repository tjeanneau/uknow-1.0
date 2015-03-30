<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/03/15
 * Time: 10:27
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Form\RechercheType;
use Uknow\PlatformBundle\Services;

class NavigationController extends Controller{

    public function homeAction(){
        return $this->render('UknowPlatformBundle:navigation:home.html.twig');
    }

    public function rechercheAction($lettres, Request $request){

        $recherche = new FormulaireRechercher();
        $formRecherche = $this->get('form.factory')->create(new RechercheType(), $recherche);

        if($formRecherche->handleRequest($request)->isValid() || $lettres != null){

            if($lettres == null){
                $lettres = $recherche->getRecherche();
            }
            $em = $this->getDoctrine()->getManager();
            $servicesTri = $this->container->get('uknow_platform.tri');
            $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
            $servicesModifications = $this->container->get('uknow_platform.modification');
            $servicesRecherche = $this->container->get('uknow_platform.recherche');

            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();
            $listDonnees = $servicesModifications->listAJour($listDonnees);

            $compte = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowUtilisateurBundle:Compte')
                ->find($this->getUser()->getId());

            $listCompte = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowUtilisateurBundle:Compte')
                ->findAll();

            $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
            $em->persist($compte);
            $em->flush();

            $listDonnees = $servicesRecherche->affichageRecherche($listDonnees, $lettres);
            $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
            $tableauInfoSauvegarde = $servicesTri->tableauDonneesSauvegardees($listDonneesAffichage, $compte->getDonneesSauvegardees());
            $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

            return $this->render('UknowPlatformBundle:recherche:recherche.html.twig', array(
                'tableauSauvegarde' => $tableauInfoSauvegarde,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'listDonnees' => $listDonneesAffichage,
                'lettres' => $lettres,
            ));
        }

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