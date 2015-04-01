<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/03/15
 * Time: 16:31
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends Controller{

    public function profilAction(Request $request)
    {
        $profil = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowUtilisateurBundle:Compte')
            ->find($this->getUser()->getId());

        return $this->render('UknowPlatformBundle::compte.html.twig', array(
            'profil' => $profil
        ));
    }

    public function parametresAction(Request $request)
    {


    }

    public function progressionAction(Request $request)
    {


    }
}