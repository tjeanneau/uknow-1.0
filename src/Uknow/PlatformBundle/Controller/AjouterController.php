<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 20/02/15
 * Time: 13:30
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Classes\FormulaireModifierExercice;
use Uknow\PlatformBundle\Classes\FormulaireModifierCours;
use Uknow\PlatformBundle\Form\ModifierCoursType;
use Uknow\PlatformBundle\Form\ModifierExerciceType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Form\AjoutType;
use Uknow\PlatformBundle\Classes\FormulaireAjouter;
use Uknow\PlatformBundle\Entity\Donnees;
use Symfony\Component\HttpFoundation\Session\Session;

class AjouterController extends Controller{

    public function coursAction( Request $request){

        // Initialisation des variables principales

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formRecherche = $servicesRecherche->initialisationRecherche($this);
        $formQuestion = $servicesQuestion->initialisationQuestion($this);


        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        $formDonnees = $this->get('form.factory')->create(new AjoutType($servicesTri->triTableau($listStructure)), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $formAjout->getStructure()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($formAjout->getTitre());
                    if($formAjout->getType() == 'Exercice'){
                        $donnees->setTexte($formAjout->getExercice());
                    }else{
                        $donnees->setTexte($formAjout->getCours());
                    }
                    $donnees->setType($formAjout->getType());
                    $donnees->setNiveau($formAjout->getNiveau());
                    $donnees->setTemps($formAjout->getTemps());
                    $donnees->setModification(0);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();


        // Gestion de l'affichage des données

        return $this->render('UknowPlatformBundle::ajouter.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formAjout' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
            ));
    }

    public function exercicesAction( Request $request){

        // Initialisation des variables principales

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formRecherche = $servicesRecherche->initialisationRecherche($this);
        $formQuestion = $servicesQuestion->initialisationQuestion($this);


        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        $formDonnees = $this->get('form.factory')->create(new AjoutType($servicesTri->triTableau($listStructure)), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $formAjout->getStructure()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($formAjout->getTitre());
                    if($formAjout->getType() == 'Exercice'){
                        $donnees->setTexte($formAjout->getExercice());
                    }else{
                        $donnees->setTexte($formAjout->getCours());
                    }
                    $donnees->setType($formAjout->getType());
                    $donnees->setNiveau($formAjout->getNiveau());
                    $donnees->setTemps($formAjout->getTemps());
                    $donnees->setModification(0);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();


        // Gestion de l'affichage des données

        return $this->render('UknowPlatformBundle::ajouter.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formAjout' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
        ));
    }

    public function correctionAction( Request $request){

        // Initialisation des variables principales

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $em = $this->getDoctrine()->getManager();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formRecherche = $servicesRecherche->initialisationRecherche($this);
        $formQuestion = $servicesQuestion->initialisationQuestion($this);


        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        $formDonnees = $this->get('form.factory')->create(new AjoutType($servicesTri->triTableau($listStructure)), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $formAjout->getStructure()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($formAjout->getTitre());
                    if($formAjout->getType() == 'Exercice'){
                        $donnees->setTexte($formAjout->getExercice());
                    }else{
                        $donnees->setTexte($formAjout->getCours());
                    }
                    $donnees->setType($formAjout->getType());
                    $donnees->setNiveau($formAjout->getNiveau());
                    $donnees->setTemps($formAjout->getTemps());
                    $donnees->setModification(0);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();


        // Gestion de l'affichage des données

        return $this->render('UknowPlatformBundle::ajouter.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formAjout' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
        ));
    }
}