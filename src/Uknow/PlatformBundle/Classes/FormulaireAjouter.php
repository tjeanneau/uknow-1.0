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

    public function setDomaineNom($domaineNom)
    {
        $this->domaine_nom = $domaineNom;

        return $this;
    }

    public function getDomaineNom()
    {
        return $this->domaine_nom;
    }

    public function setMatiereNom($matiereNom)
    {
        $this->matiere_nom = $matiereNom;

        return $this;
    }

    public function getMatiereNom()
    {
        return $this->matiere_nom;
    }

    public function setThemeNom($themeNom)
    {
        $this->theme_nom = $themeNom;

        return $this;
    }

    public function getThemeNom()
    {
        return $this->theme_nom;
    }

    public function setChapitreNom($chapitreNom)
    {
        $this->chapitre_nom = $chapitreNom;

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