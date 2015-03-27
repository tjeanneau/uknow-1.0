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
use Uknow\PlatformBundle\Form\AjoutCoursType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Classes\FormulaireAjouter;
use Uknow\PlatformBundle\Entity\Donnees;
use Symfony\Component\HttpFoundation\Session\Session;

class AjouterController extends Controller{

    public function coursAction( Request $request){

        // Initialisation des variables principales

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesList = $this->container->get('uknow_platform.list');
        $em = $this->getDoctrine()->getManager();

        $domaines = $servicesList->listDomaine();
        $matieres = $servicesList->listMatiere();
        $themes = $servicesList->listTheme();
        $chapitres = $servicesList->listChapitre();

        $formDonnees = $this->get('form.factory')->create(new AjoutCoursType($domaines, $matieres, $themes, $chapitres), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            $donnees->setDomaineNom($formAjout->getDomaineNom());
            $donnees->setDomaineLien($servicesTri->findObjectNom($formAjout->getDomaineNom(), 'domaine', null, null, null));
            $donnees->setMatiereNom($formAjout->getMatiereNom());
            $donnees->setMatiereLien($servicesTri->findObjectNom($formAjout->getMatiereNom(), 'matiere', $donnees->getDomaineLien(), null, null));
            $donnees->setThemeNom($formAjout->getThemeNom());
            $donnees->setThemeLien($servicesTri->findObjectNom($formAjout->getThemeNom(), 'theme', $donnees->getDomaineLien(), $donnees->getMatiereLien(), null));
            $donnees->setChapitreNom($formAjout->getChapitreNom());
            $donnees->setChapitreLien($servicesTri->findObjectNom($formAjout->getChapitreNom(), 'chapitre', $donnees->getDomaineLien(), $donnees->getMatiereLien(), $donnees->getThemeLien()));
            $donnees->setTitre($formAjout->getTitre());
            $donnees->setTexte($formAjout->getCkeditor());
            $donnees->setType($formAjout->getType());
            $donnees->setNiveau($formAjout->getNiveau());
            $donnees->setTemps($formAjout->getTemps());
            $donnees->setModification(0);
            $donnees->setPertinent(0);
            $donnees->setDevelopper(0);
            $donnees->setInutile(0);
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'lienDomaine' => $donnees->getDomaineLien(),
                'lienMatiere' => $donnees->getMatiereLien(),
                'lienTheme' => $donnees->getThemeLien(),
                'lienChapitre' => $donnees->getChapitreLien(),
            )));
        }



        return $this->render('UknowPlatformBundle:ajouter:cours.html.twig', array(
            'formAjout' => $formDonnees->createView(),
            ));
    }

    public function exercicesAction( Request $request){

        // Initialisation des variables principales

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $em = $this->getDoctrine()->getManager();

        $formDonnees = $this->get('form.factory')->create(new AjoutType(), $formAjout);
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

        return $this->render('UknowPlatformBundle:ajouter:ajouter.html.twig', array(
            'formAjout' => $formDonnees->createView(),
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