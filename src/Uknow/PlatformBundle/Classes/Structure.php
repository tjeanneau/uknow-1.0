<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/03/15
 * Time: 10:41
 */

namespace Uknow\PlatformBundle\Classes;


class Structure {

    private $nom;
    private $lien;

    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setLien($lien)
    {
        $this->lien = $lien;
        return $this;
    }

    public function getLien()
    {
        return $this->lien;
    }

}