<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 11/03/15
 * Time: 16:29
 */

namespace Uknow\UtilisateurBundle\Classes;

class FormulaireConnexion {

    private $adresseMail;
    private $motDePasse;

    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;
        return $this;
    }

    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
        return $this;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }
}