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
    private $domaine_nom;
    private $matiere_nom;
    private $theme_nom;
    private $chapitre_nom;
    private $type;
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

    public function setDomaineNom($domaine_nom)
    {
        $this->domaine_nom = $domaine_nom;

        return $this;
    }

    public function getDomaineNom()
    {
        return $this->domaine_nom;
    }

    public function setMatiereNom($matiere_nom)
    {
        $this->matiere_nom = $matiere_nom;

        return $this;
    }

    public function getMatiereNom()
    {
        return $this->matiere_nom;
    }

    public function setThemeNom($theme_nom)
    {
        $this->theme_nom = $theme_nom;

        return $this;
    }

    public function getThemeNom()
    {
        return $this->theme_nom;
    }

    public function setChapitreNom($chapitre_nom)
    {
        $this->chapitre_nom = $chapitre_nom;

        return $this;
    }

    public function getChapitreNom()
    {
        return $this->chapitre_nom;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $type;
    }

    public function getType()
    {
        return $this->type;
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