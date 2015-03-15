<?php

namespace Uknow\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Structure
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Uknow\PlatformBundle\Entity\StructureRepository")
 */
class Structure
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
     * @ORM\Column(name="domaine_lien", type="string", length=255)
     */
    private $domaineLien;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere_lien", type="string", length=255)
     */
    private $matiereLien;

    /**
     * @var string
     *
     * @ORM\Column(name="theme_lien", type="string", length=255)
     */
    private $themeLien;

    /**
     * @var string
     *
     * @ORM\Column(name="chapitre_lien", type="string", length=255)
     */
    private $chapitreLien;


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
     * @return Structure
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
     * @return Structure
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
     * @return Structure
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
     * @return Structure
     */
    public function setChapitre($chapitre)
    {
        $this->chapitre = $chapitre;

        return $chapitre;
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
     * Set domaineLien
     *
     * @param string $domaineLien
     * @return Structure
     */
    public function setDomaineLien($domaineLien)
    {
        $this->domaineLien = $domaineLien;

        return $this;
    }

    /**
     * Get domaineLien
     *
     * @return string 
     */
    public function getDomaineLien()
    {
        return $this->domaineLien;
    }

    /**
     * Set matiereLien
     *
     * @param string $matiereLien
     * @return Structure
     */
    public function setMatiereLien($matiereLien)
    {
        $this->matiereLien = $matiereLien;

        return $this;
    }

    /**
     * Get matiereLien
     *
     * @return string 
     */
    public function getMatiereLien()
    {
        return $this->matiereLien;
    }

    /**
     * Set themeLien
     *
     * @param string $themeLien
     * @return Structure
     */
    public function setThemeLien($themeLien)
    {
        $this->themeLien = $themeLien;

        return $this;
    }

    /**
     * Get themeLien
     *
     * @return string 
     */
    public function getThemeLien()
    {
        return $this->themeLien;
    }

    /**
     * Set chapitreLien
     *
     * @param string $chapitreLien
     * @return Structure
     */
    public function setChapitreLien($chapitreLien)
    {
        $this->chapitreLien = $chapitreLien;

        return $this;
    }

    /**
     * Get chapitreLien
     *
     * @return string
     */
    public function getChapitreLien()
    {
        return $this->chapitreLien;
    }
}
