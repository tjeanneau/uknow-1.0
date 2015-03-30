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
use Uknow\PlatformBundle\Services;
use Symfony\Component\HttpFoundation\Session\Session;
use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Form\RechercheType;

class DonneesController extends Controller
{
    /**
     * @param $lienDomaine
     * @param $lienMatiere
     * @param $lienTheme
     * @param $lienChapitre
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function rechercheAction($lienDomaine, $lienMatiere, $lienTheme, $lienChapitre, $id)
    {

        $domaine = null;
        $matiere = null;
        $theme = null;
        $chapitre = null;
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesFiabilite = $this->container->get('uknow_platform.evaluation');
        $servicesModifications = $this->container->get('uknow_platform.modification');

        $listDonnees = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->findBy(array(
                'domaine_lien' => $lienDomaine,
                'matiere_lien' => $lienMatiere,
                'theme_lien' => $lienTheme,
                'chapitre_lien' => $lienChapitre
            ), null, null, null);
        $listDonnees = $servicesModifications->listAJour($listDonnees);

        $compte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        $listCompte = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->findAll();

        if($lienDomaine != null){
            $domaine = $servicesTri->findObjectLien($lienDomaine, 'domaine', null, null, null);
            if($domaine == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        if($lienMatiere != null){
            $matiere = $servicesTri->findObjectLien($lienMatiere, 'matiere', $lienDomaine, null, null);
            if($matiere == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        if($lienTheme != null){
            $theme = $servicesTri->findObjectLien($lienTheme, 'theme', $lienDomaine, $lienMatiere, null);
            if($theme == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        if($lienChapitre != null){
            $chapitre = $servicesTri->findObjectLien($lienChapitre, 'chapitre', $lienDomaine, $lienMatiere, $lienTheme);
            if($chapitre == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        $compte->setDonneesSauvegardees($servicesModifications->idAJour($compte->getDonneesSauvegardees(), $listDonnees));
        $em->persist($compte);
        $em->flush();
        $listDonnees = $servicesFiabilite->fiabilite($listDonnees, $listCompte, $em);
        $tableauInfoSauvegarde = $servicesTri->tableauDonneesSauvegardees($listDonnees, $compte->getDonneesSauvegardees());
        $tableauInfoEvaluation = $servicesTri->triDonneesEvaluees($listDonnees, $compte->getDonneesEvaluees());

        return $this->render('UknowPlatformBundle:donnees:donnees.html.twig', array(
            'domaine' => $domaine,
            'matiere' => $matiere,
            'theme' => $theme,
            'chapitre' => $chapitre,
            'listDonnees' => $listDonnees,
            'tableauSauvegarde' => $tableauInfoSauvegarde,
            'tableauEvaluation' => $tableauInfoEvaluation,
            'id' => $id,
        ));
    }

    public function modificationsAction($id, Request $request)
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

        return $this->render('UknowPlatformBundle:modifications:modifications.html.twig', array(
            'donnee' => $donneerecu,
            'listDonnees' => $listDonnees,
            'tableauEvaluation' => $tableauInfoEvaluation,
            'sauvegarder' => $sauvegarder,
            'id' => $id,
        ));
    }
}