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
    private $contenu;
    private $structure;
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

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setStructure($structure)
    {
        $this->structure = $structure;
        return $this;
    }

    public function getStructure()
    {
        return $this->structure;
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