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
    private $cours;
    private $exercice;
    private $domaine_nom;
    private $domaine_lien;
    private $matiere_nom;
    private $matiere_lien;
    private $theme_nom;
    private $theme_lien;
    private $chapitre_nom;
    private $chapitre_lien;
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

    public function setCours($cours)
    {
        $this->cours = $cours;
        return $this;
    }

    public function getCours()
    {
        return $this->cours;
    }

    public function setExercice($exercice)
    {
        $this->exercice = $exercice;
        return $this;
    }

    public function getExercice()
    {
        return $this->exercice;
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

    public function setDomaineLien($domaineLien)
    {
        $this->domaine_lien = $domaineLien;

        return $this;
    }

    public function getDomaineLien()
    {
        return $this->domaine_lien;
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

    public function setMatiereLien($matiereLien)
    {
        $this->matiere_lien = $matiereLien;

        return $this;
    }

    public function getMatiereLien()
    {
        return $this->matiere_lien;
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

    public function setThemeLien($themeLien)
    {
        $this->theme_lien = $themeLien;

        return $this;
    }

    public function getThemeLien()
    {
        return $this->theme_lien;
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

    public function setChapitreLien($chapitreLien)
    {
        $this->chapitre_lien = $chapitreLien;

        return $this;
    }

    public function getChapitreLien()
    {
        return $this->chapitre_lien;
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