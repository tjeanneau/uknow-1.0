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

class CartableController extends Controller{

    public function coursAction(){

        $em = $this->getDoctrine()->getManager();
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');
        $servicesTri = $this->container->get('uknow_platform.tri');

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

        $listDonnees = $servicesTri->triCours($listDonnees, $compte->getDonneesSauvegardees());
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        return $this->render('UknowPlatformBundle:cartable/cours:cours.html.twig', array(
            'tableauEvaluation' => $tableauInfoEvaluation,
            'listDonnees' => $listDonneesAffichage,
            'type' => 'cours',
        ));
    }

    public function exercicesAction(){

        $em = $this->getDoctrine()->getManager();
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');
        $servicesTri = $this->container->get('uknow_platform.tri');

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

        $listDonnees = $servicesTri->triExercice($listDonnees, $compte->getDonneesSauvegardees());
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        return $this->render('UknowPlatformBundle:cartable/exercice:exercice.html.twig', array(
            'tableauEvaluation' => $tableauInfoEvaluation,
            'listDonnees' => $listDonneesAffichage,
            'type' => 'exercice',
        ));
    }

    public function matiereAction(Request $request){

    }

    public function niveauxAction(Request $request){

    }

    public function modificationsAction($type, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findAll();

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->findAll();

        $listDonnees = $servicesTri->triDonneesModifiee($donneerecu, $listDonnees);
        $listDonneesAffichage = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $listDonneesAffichage = $servicesTri->triDonneesModifiee($donneerecu, $listDonneesAffichage);
        $sauvegarder = $servicesTri->donneesSauvegardees($donneerecu, $compte->getDonneesSauvegardees());
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonneesAffichage, $compte->getDonneesEvaluees());

        if($type == 'cours'){
            return $this->render('UknowPlatformBundle:cartable/cours:modifications.html.twig', array(
                'donnee' => $donneerecu,
                'listDonnees' => $listDonnees,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'sauvegarder' => $sauvegarder,
                'id' => $id,
            ));
        }elseif($type == 'exercice'){
            return $this->render('UknowPlatformBundle:cartable/exercice:modifications.html.twig', array(
                'donnee' => $donneerecu,
                'listDonnees' => $listDonnees,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'sauvegarder' => $sauvegarder,
                'id' => $id,
            ));
        }elseif($type == 'matiere'){
            return $this->render('UknowPlatformBundle:cartable/matiere:modifications.html.twig', array(
                'donnee' => $donneerecu,
                'listDonnees' => $listDonnees,
                'tableauEvaluation' => $tableauInfoEvaluation,
                'sauvegarder' => $sauvegarder,
                'id' => $id,
            ));
        }elseif($type == 'niveaux'){
        return $this->render('UknowPlatformBundle:cartable/niveaux:modifications.html.twig', array(
            'donnee' => $donneerecu,
            'listDonnees' => $listDonnees,
            'tableauEvaluation' => $tableauInfoEvaluation,
            'sauvegarder' => $sauvegarder,
            'id' => $id,
        ));
        }else{
            return $this->render('@UknowPlatform/erreur.html.twig');
        }
    }
}