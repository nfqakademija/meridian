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
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

class GameService
{

    protected $em;
    protected $formFactory;
    protected $userName;
    protected $gameId;
    protected $positionInGame;
    protected $userInfo;
    protected $userScores;
    protected $answerFromForm;
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

    public function getGameName()
    {
        return $this->em->getRepository('MeridianCoreBundle:Game')->find($this->getGameId())->getName();
    }

    public function getQuestionForGame()
    {
        return $this->em->getRepository('MeridianCoreBundle:GameQuestion')
            ->findOneBy(['gameId' => $this->getGameId(), 'positionInGame' => $this->getPositionInGame()])
            ->getQuestion()->getQuestion();
    }

    public function getAnswerForQuestion($gameId, $positionInGame)
    {
        return $this->em->getRepository('MeridianCoreBundle:GameQuestion')
            ->findOneBy(['gameId' => $gameId, 'positionInGame' => $positionInGame])
            ->getQuestion()->getAnswer()->getAnswer();
    }

    public function createAnswerForm(Request $request)
    {
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

    public function checkAnswerInGame($answerFromForm, $answerFromDb, Request $request)
    {
        $session = $request->getSession();
        $a1 = strtolower($answerFromForm);
        $a2 = strtolower($answerFromDb);
        $distance = $this->getDistance($answerFromForm, $answerFromDb);
        if ($a1 == $a2) {
            $session->getFlashBag()->add('notice', 'Atsakymas teisingas! Nesustok!');
            $this->setUserScores();
            $this->setPositionInGame();
            $this->isOk = true;
            if ($this->getPositionInGame() == 11) {
                $this->setNextLevelAndResetPosition();
            }
        } else {
            if ($distance == 3) {
                $session->getFlashBag()->add('notice', 'Pasistenk! Artėji prie tikslo!');
            }
            if ($distance == 2) {
                $session->getFlashBag()->add('notice', 'Liko visai nedaug!');
            }
            if ($distance == 1) {
                $session->getFlashBag()->add('notice', 'Karšta!');
            }
            if ($distance > 3) {
                $session->getFlashBag()->add('notice', 'Toli toli!');
            }
        }
    }

    public function setUserScores()
    {
        $score = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setScores($this->getUserScores() + 1);
        $this->em->persist($score);
        $this->em->flush();
    }

    public function setPositionInGame()
    {
        $position = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setPositionInGame($this->getPositionInGame() + 1);
        $this->em->persist($position);
        $this->em->flush();
    }

    public function setNextLevelAndResetPosition()
    {
        $query = $this->em->getRepository('MeridianUserBundle:User')
            ->findOneBy(['id' => $this->getUserId()])
            ->setGame($this->em->getRepository('MeridianCoreBundle:Game')
                ->findOneBy(['id' => $this->getGameId() + 1]))
            ->setPositionInGame(1)
            ->setLevel($this->getUserLevel() + 1);
        $this->em->persist($query);
        $this->em->flush();
    }
} 