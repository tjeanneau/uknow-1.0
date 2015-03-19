<?php

namespace Uknow\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Donnees
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Uknow\PlatformBundle\Entity\DonneesRepository")
 */
class Donnees
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=255)
     */
    private $domaine;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=255)
     */
    private $matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="chapitre", type="string", length=255)
     */
    private $chapitre;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="texte", type="text")
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="modification", type="integer")
     */
    private $modification;

    /**
     * @var integer
     *
     * @ORM\Column(name="positive", type="integer")
     */
    private $positive;

    /**
     * @var integer
     *
     * @ORM\Column(name="negative", type="integer")
     */
    private $negative;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=255)
     */
    private $niveau;

    /**
     * @var integer
     *
     * @ORM\Column(name="fiabilite", type="integer")
     */
    private $fiabilite;

    /**
     * @var integer
     *
     * @ORM\Column(name="temps", type="integer")
     */
    private $temps;

    public function __construct(){
        $this->date = new \DateTime();
        $this->modification = 0;
        $this->positive = 0;
        $this->negative = 0;
        $this->fiabilite = 0;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set domaine
     *
     * @param string $domaine
     * @return Donnees
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return string 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Set matiere
     *
     * @param string $matiere
     * @return Donnees
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set theme
     *
     * @param string $theme
     * @return Donnees
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set chapitre
     *
     * @param string $chapitre
     * @return Donnees
     */
    public function setChapitre($chapitre)
    {
        $this->chapitre = $chapitre;

        return $this;
    }

    /**
     * Get chapitre
     *
     * @return string
     */
    public function getChapitre()
    {
        return $this->chapitre;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Donnees
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     * @return Donnees
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string 
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Donnees
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set modification
     *
     * @param integer $modification
     * @return Donnees
     */
    public function setModification($modification)
    {
        $this->modification = $modification;

        return $this;
    }

    /**
     * Get modification
     *
     * @return integer 
     */
    public function getModification()
    {
        return $this->modification;
    }

    /**
     * Set positive
     *
     * @param integer $positive
     * @return Donnees
     */
    public function setPositive($positive)
    {
        $this->positive = $positive;

        return $this;
    }

    /**
     * Get positive
     *
     * @return integer 
     */
    public function getPositive()
    {
        return $this->positive;
    }

    /**
     * Set negative
     *
     * @param integer $negative
     * @return Donnees
     */
    public function setNegative($negative)
    {
        $this->negative = $negative;

        return $this;
    }

    /**
     * Get negative
     *
     * @return integer 
     */
    public function getNegative()
    {
        return $this->negative;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Donnees
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set niveau
     *
     * @param string  $niveau
     * @return string
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set fiabilite
     *
     * @param integer $fiabilite
     * @return Donnees
     */
    public function setFiabilite($fiabilite)
    {
        $this->fiabilite = $fiabilite;

        return $this;
    }

    /**
     * Get fiabilite
     *
     * @return integer
     */
    public function getFiabilite()
    {
        return $this->fiabilite;
    }

    /**
     * Set temps
     *
     * @param integer $temps
     * @return Donnees
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps
     *
     * @return integer
     */
    public function getTemps()
    {
        return $this->temps;
    }
}
