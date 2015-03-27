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
use Symfony\Component\HttpFoundation\Session\Session;

class StructureController extends Controller
{
    public function structureAction($lienDomaine, $lienMatiere, $lienTheme)
    {
        $tableauBadge = array();
        $domaine = null;
        $matiere = null;
        $theme = null;
        $servicesTri = $this->container->get('uknow_platform.tri');

        if($lienTheme != null){
            $listStructure = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Structure')
                ->findAll();
            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();
            $tableauBadge = $servicesTri->triDonneesList($listStructure, $listDonnees);
        }

        if($lienDomaine != null){
            $domaine = $servicesTri->findObject($lienDomaine, 'domaine', null, null, null);
            if($domaine == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        if($lienMatiere != null){
            $matiere = $servicesTri->findObject($lienMatiere, 'matiere', $lienDomaine, null, null);
            if($matiere == null){
                return $this->render('UknowPlatformBundle::erreur.html.twig');
            }
        }

        if($lienTheme != null){
            $theme = $servicesTri->findObject($lienTheme, 'theme', $lienDomaine, $lienMatiere, null);
            if($domaine == null){
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