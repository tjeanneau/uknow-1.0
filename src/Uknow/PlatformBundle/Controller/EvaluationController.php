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

class EvaluationController extends Controller{

    public function exerciceAction(Request $request){

        return $this->render('UknowPlatformBundle::evaluation.html.twig');
    }

    public function testAction(Request $request){

        return $this->render('UknowPlatformBundle::evaluation.html.twig');
    }

    public function examenAction(Request $request){

        return $this->render('UknowPlatformBundle::evaluation.html.twig');
    }

    public function resultatsAction(Request $request){


        return $this->render('UknowPlatformBundle::evaluation.html.twig');
    }

    public function corrigerAction(Request $request){

        return $this->render('UknowPlatformBundle::evaluation.html.twig');
    }

}