<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 24/02/15
 * Time: 11:46
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireRechercher
{

    private $recherche;

    public function setRecherche($recherche)
    {
        $this->recherche = $recherche;
        return $this;
    }

    public function getRecherche()
    {
        return $this->recherche;
    }

}