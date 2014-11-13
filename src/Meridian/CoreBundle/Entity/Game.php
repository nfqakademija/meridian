<?php

namespace Meridian\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Game
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Meridian\CoreBundle\Entity\GameRepository")
 */
class Game
{
    /**
     * @ORM\ManyToMany(targetEntity="Meridian\CoreBundle\Entity\Questions", inversedBy="game")
     * @ORM\JoinTable(name="game_question")
     **/
   protected $questionss;

    public function __construct()
    {
        $this->questionss = new ArrayCollection();
    }

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="gamefoto", type="string", length=255)
     */
    private $gamefoto;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=20)
     */
    private $status;


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
     * Set name
     *
     * @param string $name
     * @return Game
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return Game
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Game
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set gamefoto
     *
     * @param string $gamefoto
     * @return Game
     */
    public function setGamefoto($gamefoto)
    {
        $this->gamefoto = $gamefoto;

        return $this;
    }

    /**
     * Get gamefoto
     *
     * @return string 
     */
    public function getGamefoto()
    {
        return $this->gamefoto;
    }

    /**
     * Add questionss
     *
     * @param \Meridian\CoreBundle\Entity\Questions $questionss
     * @return Game
     */
    public function addQuestionss(\Meridian\CoreBundle\Entity\Questions $questionss)
    {
        $this->questionss[] = $questionss;

        return $this;
    }

    /**
     * Remove questionss
     *
     * @param \Meridian\CoreBundle\Entity\Questions $questionss
     */
    public function removeQuestionss(\Meridian\CoreBundle\Entity\Questions $questionss)
    {
        $this->questionss->removeElement($questionss);
    }

    /**
     * Get questionss
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionss()
    {
        return $this->questionss;
    }
}
