<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 09:44
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireModifierExercice {

    private $exercice;
    private $temps;

    public function setExercice($exercice)
    {
        $this->exercice = $exercice;
        return $this;
    }

    public function getExercice()
    {
        return $this->exercice;
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