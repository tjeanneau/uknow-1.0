<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 11:43
 */

namespace Uknow\PlatformBundle\Services;

use Uknow\PlatformBundle\Form\QuestionType;
use Uknow\PlatformBundle\Entity\Question;

class ServiceQuestion {

    public function initialisationQuestion($thisController){

        $question = new Question();
        $formQuestion = $thisController->get('form.factory')->create(new QuestionType(), $question);
        return $formQuestion;
    }

    public function enregistrementQuestion(){

    }
}