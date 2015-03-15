<?php

namespace Uknow\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UknowUtilisateurBundle:Default:index.html.twig', array('name' => $name));
    }
}
