<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 09:44
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireModifierCours {

    private $cours;
    private $temps;

    public function setCours($cours)
    {
        $this->cours = $cours;
        return $this;
    }

    public function getCours()
    {
        return $this->cours;
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