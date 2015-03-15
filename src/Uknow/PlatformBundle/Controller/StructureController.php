<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/02/15
 * Time: 16:10
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Entity\Question;
use Uknow\PlatformBundle\Form\RechercheType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Form\QuestionType;
use Symfony\Component\HttpFoundation\Session\Session;

class StructureController extends Controller
{
    public function structureAction( $domaine, $matiere, $theme, $chapitre, Request $request)
    {

        // Initialisation des variables principales

        $titreDomaine = null;
        $titreDomaineLien = null;
        $titreMatiere = null;
        $titreMatiereLien = null;
        $titreTheme = null;
        $titreAffichage = null;
        $session = new Session();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);
        $em = $this->getDoctrine()->getManager();


        // Vérification de la session

        if ($session->get('identifiant', null) == null){
            return $this->redirect($this->generateUrl('uknow_connexion'));
        }


        // Initialisation des bases de données à utiliser



        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){
            $servicesQuestion->enregistrementQuestion();
        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();


        // Gestion de l'affichage des données

         if($domaine != null){
            if($matiere != null){
                if($theme != null){
                    $listStructure = $servicesTri->triChapitre($listStructure, $domaine, $matiere, $theme, 'structure');
                }else {
                    $listStructure = $servicesTri->triTheme($listStructure, $domaine, $matiere, 'structure');
                }
            }else {
                $listStructure = $servicesTri->triMatiere($listStructure, $domaine, 'structure');
            }
        }else{
            $listStructure = $servicesTri->triDomaine($listStructure, 'structure');
        }

        if ($listStructure == null){
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'listQuestion' => $listQuestion));
        }else {
            $titreDomaine = $listStructure[0]->getDomaine();
            $titreMatiere = $listStructure[0]->getMatiere();
            $titreTheme = $listStructure[0]->getTheme();
        }

        return $this->render('UknowPlatformBundle::structure.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'titreDomaine' => $titreDomaine,
            'titreMatiere' => $titreMatiere,
            'titreTheme' => $titreTheme,
            'domaine' => $domaine,
            'matiere' => $matiere,
            'theme' => $theme,
            'chapitre' => $chapitre,
            'listQuestion' => $listQuestion,
            'listStructure' => $listStructure ));
    }
}