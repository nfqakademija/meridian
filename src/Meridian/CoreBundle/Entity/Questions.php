<?php

namespace Meridian\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Questions
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Meridian\CoreBundle\Entity\QuestionsRepository")
 */
class Questions
{

    // ...
    /**
     * @ORM\ManyToMany(targetEntity="Meridian\CoreBundle\Entity\Game", mappedBy="questionss")
     **/
    private $game;

    public function __construct() {
        $this->game = new ArrayCollection();
    }

    /**
     * @ORM\OneToOne(targetEntity="Answers")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     **/

    protected  $answers;

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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="question_foto", type="string", length=255)
     */
    private $questionFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="answer_id", type="integer")
     */

    private $answerId;


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
     * Set question
     *
     * @param string $question
     * @return Questions
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set questionFoto
     *
     * @param string $questionFoto
     * @return Questions
     */
    public function setQuestionFoto($questionFoto)
    {
        $this->questionFoto = $questionFoto;

        return $this;
    }

    /**
     * Get questionFoto
     *
     * @return string 
     */
    public function getQuestionFoto()
    {
        return $this->questionFoto;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Questions
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
     * Set answerId
     *
     * @param integer $answerId
     * @return Questions
     */
    public function setAnswerId($answerId)
    {
        $this->answerId = $answerId;

        return $this;
    }

    /**
     * Get answerId
     *
     * @return integer 
     */
    public function getAnswerId()
    {
        return $this->answerId;
    }

    /**
     * Set answers
     *
     * @param \Meridian\CoreBundle\Entity\Answers $answers
     * @return Questions
     */
    public function setAnswers(\Meridian\CoreBundle\Entity\Answers $answers = null)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Get answers
     *
     * @return \Meridian\CoreBundle\Entity\Answers 
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Add game
     *
     * @param \Meridian\CoreBundle\Entity\Game $game
     * @return Questions
     */
    public function addGame(\Meridian\CoreBundle\Entity\Game $game)
    {
        $this->game[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param \Meridian\CoreBundle\Entity\Game $game
     */
    public function removeGame(\Meridian\CoreBundle\Entity\Game $game)
    {
        $this->game->removeElement($game);
    }

    /**
     * Get game
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGame()
    {
        return $this->game;
    }
}
