<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 23/02/15
 * Time: 09:52
 */

namespace Uknow\PlatformBundle\Classes;

class FormulaireAjouter {

    private $titre;
    private $ckeditor;
    private $domaine_lien;
    private $matiere_lien;
    private $theme_lien;
    private $chapitre_lien;
    private $niveau;
    private $modification;
    private $temps;

    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setCkeditor($ckeditor)
    {
        $this->ckeditor = $ckeditor;
        return $this;
    }

    public function getCkeditor()
    {
        return $this->ckeditor;
    }

    public function setDomaineLien($domaine_lien)
    {
        $this->domaine_lien = $domaine_lien;

        return $this;
    }

    public function getDomaineLien()
    {
        return $this->domaine_lien;
    }

    public function setMatiereLien($matiere_lien)
    {
        $this->matiere_lien = $matiere_lien;

        return $this;
    }

    public function getMatiereLien()
    {
        return $this->matiere_lien;
    }

    public function setThemeLien($theme_lien)
    {
        $this->theme_lien = $theme_lien;

        return $this;
    }

    public function getThemeLien()
    {
        return $this->theme_lien;
    }

    public function setChapitreLien($chapitre_lien)
    {
        $this->chapitre_lien = $chapitre_lien;

        return $this;
    }

    public function getChapitreLien()
    {
        return $this->chapitre_lien;
    }


    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;
        return $this;
    }

    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setModification($modification)
    {
        $this->modification = $modification;
        return $modification;
    }

    public function getModification()
    {
        return $this->modification;
    }

    public function setTemps($temps)
    {
        $this->temps = $temps;
        return $temps;
    }

    public function getTemps()
    {
        return $this->temps;
    }

}