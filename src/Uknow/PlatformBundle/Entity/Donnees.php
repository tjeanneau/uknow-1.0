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
     * @ORM\Column(name="domaine_nom", type="string", length=255)
     */
    private $domaine_nom;

    /**
     * @var string
     *
     * @ORM\Column(name="domaine_lien", type="string", length=255)
     */
    private $domaine_lien;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere_nom", type="string", length=255)
     */
    private $matiere_nom;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere_lien", type="string", length=255)
     */
    private $matiere_lien;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_nom", type="string", length=255)
     */
    private $theme_nom;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_lien", type="string", length=255)
     */
    private $theme_lien;

    /**
     * @var string
     *
     * @ORM\Column(name="chapitre_nom", type="string", length=255)
     */
    private $chapitre_nom;

    /**
     * @var string
     *
     * @ORM\Column(name="chapitre_lien", type="string", length=255)
     */
    private $chapitre_lien;

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
     * @ORM\Column(name="pertinent", type="integer")
     */
    private $pertinent;

    /**
     * @var integer
     *
     * @ORM\Column(name="developper", type="integer")
     */
    private $developper;

    /**
     * @var integer
     *
     * @ORM\Column(name="inutile", type="integer")
     */
    private $inutile;

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
     * Set domaine_nom
     *
     * @param string $domaineNom
     * @return Donnees
     */
    public function setDomaineNom($domaineNom)
    {
        $this->domaine_nom = $domaineNom;

        return $this;
    }

    /**
     * Get domaine_nom
     *
     * @return string 
     */
    public function getDomaineNom()
    {
        return $this->domaine_nom;
    }

    /**
     * Set domaine_lien
     *
     * @param string $domaineLien
     * @return Donnees
     */
    public function setDomaineLien($domaineLien)
    {
        $this->domaine_lien = $domaineLien;

        return $this;
    }

    /**
     * Get domaine_lien
     *
     * @return string 
     */
    public function getDomaineLien()
    {
        return $this->domaine_lien;
    }

    /**
     * Set matiere_nom
     *
     * @param string $matiereNom
     * @return Donnees
     */
    public function setMatiereNom($matiereNom)
    {
        $this->matiere_nom = $matiereNom;

        return $this;
    }

    /**
     * Get matiere_nom
     *
     * @return string 
     */
    public function getMatiereNom()
    {
        return $this->matiere_nom;
    }

    /**
     * Set matiere_lien
     *
     * @param string $matiereLien
     * @return Donnees
     */
    public function setMatiereLien($matiereLien)
    {
        $this->matiere_lien = $matiereLien;

        return $this;
    }

    /**
     * Get matiere_lien
     *
     * @return string 
     */
    public function getMatiereLien()
    {
        return $this->matiere_lien;
    }

    /**
     * Set theme_nom
     *
     * @param string $themeNom
     * @return Donnees
     */
    public function setThemeNom($themeNom)
    {
        $this->theme_nom = $themeNom;

        return $this;
    }

    /**
     * Get theme_nom
     *
     * @return string 
     */
    public function getThemeNom()
    {
        return $this->theme_nom;
    }

    /**
     * Set theme_lien
     *
     * @param string $themeLien
     * @return Donnees
     */
    public function setThemeLien($themeLien)
    {
        $this->theme_lien = $themeLien;

        return $this;
    }

    /**
     * Get theme_lien
     *
     * @return string 
     */
    public function getThemeLien()
    {
        return $this->theme_lien;
    }

    /**
     * Set chapitre_nom
     *
     * @param string $chapitreNom
     * @return Donnees
     */
    public function setChapitreNom($chapitreNom)
    {
        $this->chapitre_nom = $chapitreNom;

        return $this;
    }

    /**
     * Get chapitre_nom
     *
     * @return string 
     */
    public function getChapitreNom()
    {
        return $this->chapitre_nom;
    }

    /**
     * Set chapitre_lien
     *
     * @param string $chapitreLien
     * @return Donnees
     */
    public function setChapitreLien($chapitreLien)
    {
        $this->chapitre_lien = $chapitreLien;

        return $this;
    }

    /**
     * Get chapitre_lien
     *
     * @return string 
     */
    public function getChapitreLien()
    {
        return $this->chapitre_lien;
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
     * Set pertinent
     *
     * @param integer $pertinent
     * @return Donnees
     */
    public function setPertinent($pertinent)
    {
        $this->pertinent = $pertinent;

        return $this;
    }

    /**
     * Get pertinent
     *
     * @return integer 
     */
    public function getPertinent()
    {
        return $this->pertinent;
    }

    /**
     * Set developper
     *
     * @param integer $developper
     * @return Donnees
     */
    public function setDevelopper($developper)
    {
        $this->developper = $developper;

        return $this;
    }

    /**
     * Get developper
     *
     * @return integer 
     */
    public function getDevelopper()
    {
        return $this->developper;
    }

    /**
     * Set inutile
     *
     * @param integer $inutile
     * @return Donnees
     */
    public function setInutile($inutile)
    {
        $this->inutile = $inutile;

        return $this;
    }

    /**
     * Get inutile
     *
     * @return integer 
     */
    public function getInutile()
    {
        return $this->inutile;
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
     * @param string $niveau
     * @return Donnees
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
