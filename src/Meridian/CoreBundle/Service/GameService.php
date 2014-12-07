<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.14
 * Time: 14.38
 */

namespace Meridian\CoreBundle\Service;


use Doctrine\ORM\EntityManager;
use Meridian\CoreBundle\Form\Type\DemoType;
use Proxies\__CG__\Meridian\CoreBundle\Entity\Game;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Meridian\UserBundle\Entity\User;

class GameService
{
    /**
     * @var EntityManager
     */
    protected $em;
    protected $formFactory;
    protected $userName;
    protected $gameStatus;
    protected $positionInGame;
    /**
     * @var User
     */
    protected $userInfo;
    protected $userScores;
    protected $answerFromForm;
    protected $qQty;
    protected $isOk = false;


    public function __construct(EntityManager $entityManager, FormFactory $formFactory)
    {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function getUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserId()
    {
        return $this->userInfo->getId();
    }

    public function getGameId()
    {
        return $this->userInfo->getGameId();
    }

    /**
     * found distance between user answer and answer from database
     * @param $str1
     * @param $str2
     * @return int
     */
    public function getDistance($str1, $str2)
    {
        return levenshtein($str1, $str2);
    }

    public function getPositionInGame()
    {
        return $this->positionInGame = $this->userInfo->getpositionInGame();
    }

    public function getUserScores()
    {
        return $this->userInfo->getScores();
    }

    /**
     * hold all information about user
     * @param $userInfo
     */
    public function getUserInfo($userInfo)
    {
        $this->userInfo = $userInfo;
    }

    public function answerIsOk()
    {
        return $this->isOk;
    }

    public function getUserLevel()
    {
        return $this->userInfo->getLevel();
    }

    /**
     * @return string
     */
    public function getGameName()
    {
        if ($this->checkGame($this->getGameId())) {
            return $this->em->getRepository('MeridianCoreBundle:Game')
                ->find($this->getGameId())->getName();
        }
    }

    public function getUserGameStatus()
    {
        return $this->userInfo->getGameStatus();
    }

    public function getUserGameObjectName()
    {
        return $this->userInfo->getObjectName();
    }

    /**
     * false - open questions in web site
     * true - questions in museum
     * @param $id
     * @return string
     */
    public function getGameStatus($id)
    {
        return $this->em->getRepository('MeridianCoreBundle:Game')
            ->find($id)
            ->getStatus();
    }

    /**
     * get museum name from database
     * @param $id
     * @return string
     */
    public function getGameObjectName($id)
    {
        return $this->em->getRepository('MeridianCoreBundle:Game')
            ->find($id)
            ->getObjectName();
    }

    /**
     * get question by game id and position in game
     * @param Request $request
     * @return string
     */
    public function getQuestionForGame(Request $request)
    {
        if ($this->getPositionInGame() != $this->qQty + 1 && !$this->checkGame($this->getGameId() + 1)
            || $this->getQuestionsQuantity($this->getGameId()) >= 5
        ) {
            return $this->em->getRepository('MeridianCoreBundle:GameQuestion')
                ->findOneBy(['gameId' => $this->getGameId(), 'positionInGame' => $this->getPositionInGame()])
                ->getQuestion()->getQuestion();
        }
    }

    /**
     * get answer from database
     * @param $gameId
     * @param $positionInGame
     * @return string
     */
    public function getAnswerForQuestion($gameId, $positionInGame)
    {
        return $this->em->getRepository('MeridianCoreBundle:GameQuestion')
            ->findOneBy(['gameId' => $gameId, 'positionInGame' => $positionInGame])
            ->getQuestion()->getAnswer()->getAnswer();
    }

    /**
     * build answer input form
     * @param Request $request
     * @return \Symfony\Component\Form\Form
     */
    public function createAnswerForm(Request $request)
    {
        if ($this->checkGame($this->getGameId())) {
            $this->form = $this->formFactory->createBuilder(new DemoType())
                ->add('Siųsti', 'submit')
                ->getForm();
            $this->answerFromForm = $this->form->handleRequest($request)->getData();
            if ($this->form->isValid()) {
                $this->checkAnswerInGame(implode($this->answerFromForm),
                    $this->getAnswerForQuestion($this->getGameId(), $this->getPositionInGame()),
                    $request);
            }
            return $this->form;
        }
    }

    /**
     * empty form
     * @return \Symfony\Component\Form\Form
     */
    public function emptyForm()
    {
        return $this->formFactory->createBuilder()->getForm();
    }

    /**
     * check if user answer is equal answer from database
     * @param $answerFromForm
     * @param $answerFromDb
     * @param Request $request
     */
    public function checkAnswerInGame($answerFromForm, $answerFromDb, Request $request)
    {
        $a1 = mb_strtolower($answerFromForm);
        $a2 = mb_strtolower($answerFromDb);
        $distance = $this->getDistance($a1, $a2);
        if ($a1 == $a2) {
            $this->setCorrectAnswerValues($request->getSession($request));
        } else {
            $this->getDistanceNotice($distance, $request->getSession($request));
        }
    }

    /**
     * add 1 to userScores
     */
    public function setUserScores()
    {
        $score = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setScores($this->getUserScores() + 1);
        $this->em->persist($score);
        $this->em->flush();
    }

    /**
     * add 1 to positionInGame
     */
    public function setPositionInGame()
    {
        $position = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setPositionInGame($this->getPositionInGame() + 1);
        $this->em->persist($position);
        $this->em->flush();
    }

    /**
     * reset positionInGame to 1
     * add 1 to level
     */
    public function setNextLevelAndResetPosition()
    {
        $query = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setGame($this->em->getRepository('MeridianCoreBundle:Game')
                ->findOneBy(['id' => $this->getGameId() + 1]))
            ->setPositionInGame($this->getFirstQuestionPositionForNextLevel())
            ->setLevel($this->getUserLevel() + 1);
        $this->em->persist($query);
        $this->em->flush();
    }

    /**
     * is answer is correct add notice, and game values
     * @param $session
     */
    public function setCorrectAnswerValues($session)
    {
        $session->getFlashBag()->add('notice', 'Atsakymas teisingas! Nesustok!');
        $this->setUserScores();
        $this->setPositionInGame();
        $this->isOk = true;
        if ($this->getPositionInGame() == $this->qQty + 1 && $this->checkGame($this->getGameId() + 1)
            && $this->getQuestionsQuantity($this->getGameId() + 1) > 5
        ) {
            $this->setNextLevelAndResetPosition();
        }
    }

    /**
     * Add notice message
     * @param $distance
     * @param $session
     */
    public function getDistanceNotice($distance, $session)
    {
        if ($distance == 3) {
            $session->getFlashBag()->add('notice', 'Pasistenk! Artėji prie tikslo!');
            return;
        }
        if ($distance == 2) {
            $session->getFlashBag()->add('notice', 'Liko visai nedaug!');
            return;
        }
        if ($distance == 1) {
            $session->getFlashBag()->add('notice', 'Karšta!');
            return;
        }
        if ($distance > 3) {
            $session->getFlashBag()->add('notice', 'Toli toli!');
            return;
        }
    }

    public function checkGame($gameId)
    {
        if (!$this->em->getRepository('MeridianCoreBundle:Game')->find($gameId)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $session
     */
    public function noActiveGame($session)
    {
        $session->getFlashBag()->add('notice', 'Šiuo metu nėra daugiau aktyvių žaidimų!');
    }

    /**
     * set next level and position to then new game is added and have questions
     * @internal param $session
     */
    public function returnToGame()
    {
        if ($this->getPositionInGame() == $this->getQuestionsQuantity($this->getGameId()) + 1
            && $this->checkGame($this->getGameId() + 1) && $this->getQuestionsQuantity($this->getGameId() + 1) >= 5
        ) {
            $this->setNextLevelAndResetPosition();
        }
    }


    /**
     * @param $gameId
     * @return int
     */
    public function getQuestionsQuantity($gameId)
    {
        $q = $this->em->getRepository('MeridianCoreBundle:GameQuestion')->findBy(array('gameId' => $gameId));
        $qQty = count($q);
        $this->qQty = $qQty;
        return $qQty;
    }

    /**
     * @return int
     */
    public function getFirstQuestionPositionForNextLevel()
    {
        if ($this->checkGame($this->getGameId() + 1) && $this->getQuestionsQuantity($this->getGameId() + 1) >= 5) {
            return $this->em->getRepository('MeridianCoreBundle:GameQuestion')->findOneBy(['gameId' => $this->getGameId() + 1],
                ['positionInGame' => 'ASC'])->getPositionInGame();
        }
    }
} 