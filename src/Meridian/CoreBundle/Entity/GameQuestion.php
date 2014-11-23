<?php

namespace Meridian\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameQuestion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Meridian\CoreBundle\Entity\GameQuestionRepository")
 */
class GameQuestion
{
    /**
     * @ORM\ManyToOne(targetEntity="Meridian\CoreBundle\Entity\Game", inversedBy="gameQuestions", cascade={"persist"})
     * @ORM\JoinColumn(name="gameId", referencedColumnName="id")
     **/
    protected $game;

    /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="questionGames")
     * @ORM\JoinColumn(name="questionId", referencedColumnName="id")
     **/
    protected $question;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="gameId", type="integer")
     */
    private $gameId;

    /**
     * @var integer
     *
     * @ORM\Column(name="questionId", type="integer")
     */
    private $questionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="positionInGame", type="integer")
     */
    private $positionInGame;


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
     * Set gameId
     *
     * @param integer $gameId
     * @return GameQuestion
     */
    public function setGameId($gameId)
    {
        $this->gameId = $gameId;

        return $this;
    }

    /**
     * Get gameId
     *
     * @return integer 
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * Set questionId
     *
     * @param integer $questionId
     * @return GameQuestion
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer 
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set positionInGame
     *
     * @param integer $positionInGame
     * @return GameQuestion
     */
    public function setPositionInGame($positionInGame)
    {
        $this->positionInGame = $positionInGame;

        return $this;
    }

    /**
     * Get positionInGame
     *
     * @return integer 
     */
    public function getPositionInGame()
    {
        return $this->positionInGame;
    }

    /**
     * Set game
     *
     * @param \Meridian\CoreBundle\Entity\Game $game
     * @return GameQuestion
     */
    public function setGame(\Meridian\CoreBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Meridian\CoreBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set question
     *
     * @param \Meridian\CoreBundle\Entity\Question $question
     * @return GameQuestion
     */
    public function setQuestion(\Meridian\CoreBundle\Entity\Question $question = null)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get question
     *
     * @return \Meridian\CoreBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }
}
