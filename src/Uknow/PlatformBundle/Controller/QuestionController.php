<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/03/15
 * Time: 10:28
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Uknow\PlatformBundle\Services;
use Symfony\Component\HttpFoundation\Session\Session;

class QuestionController extends Controller{

    public function questionAction(Request $request){

        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);

        if ($formQuestion->handleRequest($request)->isValid()){
            $servicesQuestion->enregistrementQuestion();
        }

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        return $this->render('UknowPlatformBundle:question:question.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'listQuestion'  => $listQuestion
        ));
    }
}