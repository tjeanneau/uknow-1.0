<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 19/03/15
 * Time: 11:09
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller{

    public function autocompletionAction(){

        $donneesEnvoyee = array();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $request = Request::createFromGlobals();
        $lettres = $request->query->get('lettres');

        if ($this->container->get('request')->isXmlHttpRequest()) {

            $listDonnees = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Donnees')
                ->findAll();

            $listStructure = $this->getDoctrine()
                ->getManager()
                ->getRepository('UknowPlatformBundle:Structure')
                ->findAll();

            $donneesEnvoyee = $servicesRecherche->donneesRecherche($listDonnees, $listStructure, $lettres);

        }

        $response = new Response(json_encode($donneesEnvoyee));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}