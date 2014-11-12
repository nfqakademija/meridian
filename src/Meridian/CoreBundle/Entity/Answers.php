<?php

namespace Meridian\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Answers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Meridian\CoreBundle\Entity\AnswersRepository")
 */

class Answers
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
     * @ORM\Column(name="answer", type="string", length=255)
     */

    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="answerfoto", type="string", length=255)
     */
    private $answerfoto;
    

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
     * Set answer
     *
     * @param string $answer
     * @return Answers
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Answers
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
     * Set answerfoto
     *
     * @param string $answerfoto
     * @return Answers
     */
    public function setAnswerfoto($answerfoto)
    {
        $this->answerfoto = $answerfoto;

        return $this;
    }

    /**
     * Get answerfoto
     *
     * @return string 
     */
    public function getAnswerfoto()
    {
        return $this->answerfoto;
    }

}
