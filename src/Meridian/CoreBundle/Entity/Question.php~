<?php

namespace Meridian\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Meridian\CoreBundle\Entity\QuestionRepository")
 */


class Question
{
    /**
     * @ORM\OneToOne(targetEntity="Answer")
     * @ORM\JoinColumn(name="answerId", referencedColumnName="id")
     **/
    private $answer;

    /**
     * @ORM\OneToMany(targetEntity="GameQuestion", mappedBy="question")
     **/

    protected $questionGames;

    public function __construct() {
        $this->questionGames = new ArrayCollection();
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
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="answerId", type="integer", nullable=true)
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
     * @return Question
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
     * Set image
     *
     * @param string $image
     * @return Question
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Question
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
     * @return Question
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
     * Set answer
     *
     * @param \Meridian\CoreBundle\Entity\Answer $answer
     * @return Question
     */
    public function setAnswer(\Meridian\CoreBundle\Entity\Answer $answer = null)
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * Get answer
     *
     * @return \Meridian\CoreBundle\Entity\Answer 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Add questionGames
     *
     * @param \Meridian\CoreBundle\Entity\GameQuestion $questionGames
     * @return Question
     */
    public function addQuestionGame(\Meridian\CoreBundle\Entity\GameQuestion $questionGames)
    {
        $this->questionGames[] = $questionGames;

        return $this;
    }

    /**
     * Remove questionGames
     *
     * @param \Meridian\CoreBundle\Entity\GameQuestion $questionGames
     */
    public function removeQuestionGame(\Meridian\CoreBundle\Entity\GameQuestion $questionGames)
    {
        $this->questionGames->removeElement($questionGames);
    }

    /**
     * Get questionGames
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuestionGames()
    {
        return $this->questionGames;
    }
}
