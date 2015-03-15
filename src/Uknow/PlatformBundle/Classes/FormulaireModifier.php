<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 09:44
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireModifier {

    private $contenu;
    private $temps;

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setTemps($temps)
    {
        $this->temps = $temps;
        return $this;
    }

    public function getTemps()
    {
        return $this->temps;
    }
}