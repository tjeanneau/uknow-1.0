<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 09:44
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireModifier {

    private $ckeditor;
    private $temps;
    private $correction;

    public function setCkeditor($ckeditor)
    {
        $this->ckeditor = $ckeditor;
        return $this;
    }

    public function getCkeditor()
    {
        return $this->ckeditor;
    }

    public function setCorrection($correction)
    {
        $this->correction = $correction;
        return $this;
    }

    public function getCorrection()
    {
        return $this->correction;
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