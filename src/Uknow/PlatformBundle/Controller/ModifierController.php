<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 28/03/15
 * Time: 19:28
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Form\ModifierCoursType;
use Uknow\PlatformBundle\Form\ModifierExerciceType;
use Uknow\PlatformBundle\Form\ModifierCorrectionType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Classes\FormulaireModifier;
use Uknow\PlatformBundle\Entity\Donnees;

class ModifierController extends Controller{

    public function coursAction($id, Request $request){

        $donnees = new Donnees();
        $formModifier = new FormulaireModifier();
        $em = $this->getDoctrine()->getManager();
        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $formModifier->setCkeditor($donneerecu->getTexte());
        $formModifier->setTemps($donneerecu->getTemps());
        $formDonnees = $this->get('form.factory')->create(new ModifierCoursType(), $formModifier);
        if ($formDonnees->handleRequest($request)->isValid()){
            if($formModifier->getCkeditor() != $donneerecu->getTexte() && $formModifier->getTemps() != $donneerecu->getTemps()){
                $donnees->setDomaineLien($donneerecu->getDomaineLien());
                $donnees->setDomaineNom($donneerecu->getDomaineNom());
                $donnees->setMatiereLien($donneerecu->getMatiereLien());
                $donnees->setMatiereNom($donneerecu->getMatiereNom());
                $donnees->setThemeLien($donneerecu->getThemeLien());
                $donnees->setThemeNom($donneerecu->getThemeNom());
                $donnees->setChapitreLien($donneerecu->getChapitreLien());
                $donnees->setChapitreNom($donneerecu->getChapitreNom());
                $donnees->setTitre($donneerecu->getTitre());
                $donnees->setTexte($formModifier->getCkeditor());
                $donnees->setType('Cours');
                $donnees->setNiveau($donneerecu->getNiveau());
                $donnees->setTemps($formModifier->getTemps());
                $donnees->setModification(0);
                $donnees->setPertinent(0);
                $donnees->setDevelopper(0);
                $donnees->setInutile(0);
                $em->persist($donnees);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'lienDomaine' => $donneerecu->getDomaineLien(),
                'lienMatiere' => $donneerecu->getMatiereLien(),
                'lienTheme' => $donneerecu->getThemeLien(),
                'lienChapitre' => $donneerecu->getChapitreLien(),
            )));
        }

        return $this->render('UknowPlatformBundle:modifier:cours.html.twig', array(
            'formModifier' => $formDonnees->createView(),
            'donnee' => $donneerecu,
        ));
    }

    public function exerciceAction($id, Request $request){

        $donnees = new Donnees();
        $formModifier = new FormulaireModifier();
        $em = $this->getDoctrine()->getManager();
        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $formModifier->setCkeditor($donneerecu->getTexte());
        $formModifier->setTemps($donneerecu->getTemps());
        $formDonnees = $this->get('form.factory')->create(new ModifierExerciceType(), $formModifier);
        if ($formDonnees->handleRequest($request)->isValid()){
            if($formModifier->getCkeditor() != $donneerecu->getTexte() && $formModifier->getTemps() != $donneerecu->getTemps()){
                $donnees->setDomaineLien($donneerecu->getDomaineLien());
                $donnees->setDomaineNom($donneerecu->getDomaineNom());
                $donnees->setMatiereLien($donneerecu->getMatiereLien());
                $donnees->setMatiereNom($donneerecu->getMatiereNom());
                $donnees->setThemeLien($donneerecu->getThemeLien());
                $donnees->setThemeNom($donneerecu->getThemeNom());
                $donnees->setChapitreLien($donneerecu->getChapitreLien());
                $donnees->setChapitreNom($donneerecu->getChapitreNom());
                $donnees->setTitre($donneerecu->getTitre());
                $donnees->setTexte($formModifier->getCkeditor());
                $donnees->setType('Exercice');
                $donnees->setNiveau($donneerecu->getNiveau());
                $donnees->setTemps($formModifier->getTemps());
                $donnees->setModification(0);
                $donnees->setPertinent(0);
                $donnees->setDevelopper(0);
                $donnees->setInutile(0);
                $em->persist($donnees);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'lienDomaine' => $donnees->getDomaineLien(),
                'lienMatiere' => $donnees->getMatiereLien(),
                'lienTheme' => $donnees->getThemeLien(),
                'lienChapitre' => $donnees->getChapitreLien(),
            )));
        }

        return $this->render('UknowPlatformBundle:modifier:cours.html.twig', array(
            'formModifier' => $formDonnees->createView(),
            'donnee' => $donneerecu,
        ));
    }

    public function correctionAction($id, Request $request){

        $donnees = new Donnees();
        $formModifier = new FormulaireModifier();
        $em = $this->getDoctrine()->getManager();
        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);

        $formModifier->setCkeditor($donneerecu->getTexte());
        $formModifier->setTemps($donneerecu->getTemps());
        $formDonnees = $this->get('form.factory')->create(new ModifierCorrectionType(), $formModifier);
        if ($formDonnees->handleRequest($request)->isValid()){
            if($formModifier->getCkeditor() != $donneerecu->getTexte() && $formModifier->getTemps() != $donneerecu->getTemps()){
                $donnees->setDomaineLien($donneerecu->getDomaineLien());
                $donnees->setDomaineNom($donneerecu->getDomaineNom());
                $donnees->setMatiereLien($donneerecu->getMatiereLien());
                $donnees->setMatiereNom($donneerecu->getMatiereNom());
                $donnees->setThemeLien($donneerecu->getThemeLien());
                $donnees->setThemeNom($donneerecu->getThemeNom());
                $donnees->setChapitreLien($donneerecu->getChapitreLien());
                $donnees->setChapitreNom($donneerecu->getChapitreNom());
                $donnees->setTitre($donneerecu->getTitre());
                $donnees->setTexte($formModifier->getCkeditor());
                $donnees->setType('Correction');
                $donnees->setNiveau($donneerecu->getNiveau());
                $donnees->setTemps($formModifier->getTemps());
                $donnees->setModification(0);
                $donnees->setPertinent(0);
                $donnees->setDevelopper(0);
                $donnees->setInutile(0);
                $em->persist($donnees);
                $em->flush();
            }
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'lienDomaine' => $donnees->getDomaineLien(),
                'lienMatiere' => $donnees->getMatiereLien(),
                'lienTheme' => $donnees->getThemeLien(),
                'lienChapitre' => $donnees->getChapitreLien(),
            )));
        }

        return $this->render('UknowPlatformBundle:modifier:cours.html.twig', array(
            'formModifier' => $formDonnees->createView(),
            'donnee' => $donneerecu,
        ));
    }
}