<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/02/15
 * Time: 16:10
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Services;

class StructureController extends Controller
{
    public function structureAction($lienDomaine, $lienMatiere, $lienTheme)
    {
        $tableauBadge = array();
        $domaine = null;
        $matiere = null;
        $theme = null;
        $servicesTri = $this->container->get('uknow_platform.tri');
        $servicesModification = $this->container->get('uknow_platform.modification');

        if($lienTheme != null){
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();
            $listDonnees = $servicesModification->listAJour($listDonnees);
            $tableauBadge = $servicesTri->triDonneesList($listDonnees, $lienDomaine, $lienMatiere, $lienTheme);
        }

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

        $listStructure = $servicesTri->triListStructure($lienDomaine, $lienMatiere, $lienTheme);
        if($listStructure == null){
            return $this->render('UknowPlatformBundle::erreur.html.twig');
        }

        return $this->render('UknowPlatformBundle:recherche:structure.html.twig', array(
            'listStructure' => $listStructure,
            'tableauBadge' => $tableauBadge,
            'domaine' => $domaine,
            'matiere' => $matiere,
            'theme' => $theme
            ));
    }
}