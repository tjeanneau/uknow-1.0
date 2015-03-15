<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 04/03/15
 * Time: 20:38
 */

namespace Uknow\PlatformBundle\Services;

use Uknow\PlatformBundle\Classes\FormulaireRechercher;
use Uknow\PlatformBundle\Form\RechercheType;

class ServiceRecherche {

    public function initialisationRecherche($thisController){

        $recherche = new FormulaireRechercher();
        $formRecherche = $thisController->get('form.factory')->create(new RechercheType(), $recherche);
        return $formRecherche;
    }

}