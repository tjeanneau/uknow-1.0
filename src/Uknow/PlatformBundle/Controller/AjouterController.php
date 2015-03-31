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
use Uknow\PlatformBundle\Form\AjoutExerciceType;
use Uknow\PlatformBundle\Form\AjoutCorrectionType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Classes\FormulaireAjouter;
use Uknow\PlatformBundle\Entity\Donnees;

class AjouterController extends Controller{

    public function coursAction($lienDomaine, $lienMatiere, $lienTheme, $lienChapitre, Request $request){

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $formAjout->setDomaineLien($lienDomaine);
        $formAjout->setMatiereLien($lienMatiere);
        $formAjout->setThemeLien($lienTheme);
        $formAjout->setChapitreLien($lienChapitre);
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesList = $this->container->get('uknow_platform.list');
        $em = $this->getDoctrine()->getManager();

        $domaines = $servicesList->listDomaine();
        $matieres = $servicesList->listMatiere();
        $themes = $servicesList->listTheme();
        $chapitres = $servicesList->listChapitre();

        $formDonnees = $this->get('form.factory')->create(new AjoutCoursType($domaines, $matieres, $themes, $chapitres), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            $donnees->setDomaineLien($formAjout->getDomaineLien());
            $donnees->setDomaineNom($servicesTri->findObjectLien($formAjout->getDomaineLien(), 'domaine', null, null, null)->getNom());
            $donnees->setMatiereLien($formAjout->getMatiereLien());
            $donnees->setMatiereNom($servicesTri->findObjectLien($formAjout->getMatiereLien(), 'matiere', $donnees->getDomaineLien(), null, null)->getNom());
            $donnees->setThemeLien($formAjout->getThemeLien());
            $donnees->setThemeNom($servicesTri->findObjectLien($formAjout->getThemeLien(), 'theme', $donnees->getDomaineLien(), $donnees->getMatiereLien(), null)->getNom());
            $donnees->setChapitreLien($formAjout->getChapitreLien());
            $donnees->setChapitreNom($servicesTri->findObjectLien($formAjout->getChapitreLien(), 'chapitre', $donnees->getDomaineLien(), $donnees->getMatiereLien(), $donnees->getThemeLien())->getNom());
            $donnees->setTitre($formAjout->getTitre());
            $donnees->setTexte($formAjout->getCkeditor());
            $donnees->setType('Cours');
            $donnees->setNiveauLien($formAjout->getNiveau());
            $donnees->setNiveauNom($servicesTri->findObjectLien($formAjout->getNiveau(), 'niveau', null, null, null)->getNom());
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

    public function exerciceAction($lienDomaine, $lienMatiere, $lienTheme, $lienChapitre, Request $request){

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $formAjout->setDomaineLien($lienDomaine);
        $formAjout->setMatiereLien($lienMatiere);
        $formAjout->setThemeLien($lienTheme);
        $formAjout->setChapitreLien($lienChapitre);
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesList = $this->container->get('uknow_platform.list');
        $em = $this->getDoctrine()->getManager();

        $domaines = $servicesList->listDomaine();
        $matieres = $servicesList->listMatiere();
        $themes = $servicesList->listTheme();
        $chapitres = $servicesList->listChapitre();

        $formDonnees = $this->get('form.factory')->create(new AjoutExerciceType($domaines, $matieres, $themes, $chapitres), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            $donnees->setDomaineLien($formAjout->getDomaineLien());
            $donnees->setDomaineNom($servicesTri->findObjectLien($formAjout->getDomaineLien(), 'domaine', null, null, null)->getNom());
            $donnees->setMatiereLien($formAjout->getMatiereLien());
            $donnees->setMatiereNom($servicesTri->findObjectLien($formAjout->getMatiereLien(), 'matiere', $donnees->getDomaineLien(), null, null)->getNom());
            $donnees->setThemeLien($formAjout->getThemeLien());
            $donnees->setThemeNom($servicesTri->findObjectLien($formAjout->getThemeLien(), 'theme', $donnees->getDomaineLien(), $donnees->getMatiereLien(), null)->getNom());
            $donnees->setChapitreLien($formAjout->getChapitreLien());
            $donnees->setChapitreNom($servicesTri->findObjectLien($formAjout->getChapitreLien(), 'chapitre', $donnees->getDomaineLien(), $donnees->getMatiereLien(), $donnees->getThemeLien())->getNom());
            $donnees->setTitre($formAjout->getTitre());
            $donnees->setTexte($formAjout->getCkeditor());
            $donnees->setType('Exercice');
            $donnees->setNiveauLien($formAjout->getNiveau());
            $donnees->setNiveauNom($servicesTri->findObjectLien($formAjout->getNiveau(), 'niveau', null, null, null)->getNom());
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

        return $this->render('UknowPlatformBundle:ajouter:exercice.html.twig', array(
            'formAjout' => $formDonnees->createView(),
        ));
    }

    public function correctionAction($lienDomaine, $lienMatiere, $lienTheme, $lienChapitre, Request $request){

        $donnees = new Donnees();
        $formAjout = new FormulaireAjouter();
        $formAjout->setDomaineLien($lienDomaine);
        $formAjout->setMatiereLien($lienMatiere);
        $formAjout->setThemeLien($lienTheme);
        $formAjout->setChapitreLien($lienChapitre);
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesList = $this->container->get('uknow_platform.list');
        $em = $this->getDoctrine()->getManager();

        $domaines = $servicesList->listDomaine();
        $matieres = $servicesList->listMatiere();
        $themes = $servicesList->listTheme();
        $chapitres = $servicesList->listChapitre();

        $formDonnees = $this->get('form.factory')->create(new AjoutCorrectionType($domaines, $matieres, $themes, $chapitres), $formAjout);
        if ($formDonnees->handleRequest($request)->isValid()){
            $donnees->setDomaineLien($formAjout->getDomaineLien());
            $donnees->setDomaineNom($servicesTri->findObjectLien($formAjout->getDomaineLien(), 'domaine', null, null, null)->getNom());
            $donnees->setMatiereLien($formAjout->getMatiereLien());
            $donnees->setMatiereNom($servicesTri->findObjectLien($formAjout->getMatiereLien(), 'matiere', $donnees->getDomaineLien(), null, null)->getNom());
            $donnees->setThemeLien($formAjout->getThemeLien());
            $donnees->setThemeNom($servicesTri->findObjectLien($formAjout->getThemeLien(), 'theme', $donnees->getDomaineLien(), $donnees->getMatiereLien(), null)->getNom());
            $donnees->setChapitreLien($formAjout->getChapitreLien());
            $donnees->setChapitreNom($servicesTri->findObjectLien($formAjout->getChapitreLien(), 'chapitre', $donnees->getDomaineLien(), $donnees->getMatiereLien(), $donnees->getThemeLien())->getNom());
            $donnees->setTitre($formAjout->getTitre());
            $donnees->setTexte($formAjout->getCkeditor());
            $donnees->setType('Correction');
            $donnees->setNiveauLien($formAjout->getNiveau());
            $donnees->setNiveauNom($servicesTri->findObjectLien($formAjout->getNiveau(), 'niveau', null, null, null)->getNom());
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

        return $this->render('UknowPlatformBundle:ajouter:correction.html.twig', array(
            'formAjout' => $formDonnees->createView(),
        ));
    }
}