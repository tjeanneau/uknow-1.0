<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/03/15
 * Time: 12:29
 */

namespace Uknow\UtilisateurBundle\Classes;


class FormulaireInscription {

    private $id;
    private $adresseMail;
    private $motDePasse;
    private $confirmation;
    public function getId()
    {
        return $this->id;
    }
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
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
        return $this;
    }
    public function getConfirmation()
    {
        return $this->confirmation;
    }
}