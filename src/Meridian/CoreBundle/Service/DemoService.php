<?php

namespace Meridian\CoreBundle\Service;

use Doctrine\ORM\EntityRepository;
use Meridian\CoreBundle\Form\Type\DemoType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;
use Meridian\CoreBundle\Entity;
use Symfony\Component\Form;
use Symfony\Component\Routing\RouterInterface;

class DemoService
{
    protected $game = '';
    protected $question = '';
    protected $answer = '';
    protected $questionId;
    protected $nextQuestionId;
    protected $form;
    protected $answerFromForm = array();
    protected $isOk = false;
    protected $router;
    protected $gameRepo;

    public function __construct(
        EntityManager $entityManager,
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        EntityRepository $gameRepo
    ) {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->gameRepo = $gameRepo;
    }

    public function getQuestionIdForGame($questionId)
    {
        $this->questionId = $questionId;
    }

    public function getGameName($gameId)
    {
        $game = $this->gameRepo->find($gameId);
        $this->game = $game->getName();
        return $this->game;
    }

    public function getQuestionForGame($questionId)
    {
        $this->question = $this->em->getRepository('MeridianCoreBundle:Question')->find($questionId);
        return $this->question;
    }

    public function getAnswerForQuestion($questionId)
    {
        $this->answer = $this->getQuestionForGame($questionId)->getAnswer()->getAnswer();
        return $this->answer;
    }

    public function createAnswerForm(Request $request)
    {
        $this->form = $this->formFactory->createBuilder(new DemoType())
            ->add('Siųsti', 'submit')
            ->getForm();
        $this->answerFromForm = $this->form->handleRequest($request)->getData();
        if ($this->form->isValid()) {
            $this->checkAnswer($this->getAnswerForQuestion($this->questionId), implode($this->answerFromForm),
                $request);
        }
        return $this->form;
    }


    public function checkAnswer($a1, $a2, Request $request)
    {
        $session = $request->getSession();
        $a1 = strtolower($a1);
        $a2 = strtolower($a2);
        if ($a1 == $a2) {
            $session->getFlashBag()->add('notice', 'Atsakymas teisingas! Nesustok!');
            $this->isOk = true;
            $this->nextQuestionId = $this->questionId + 1;
        } else {
            $session->getFlashBag()->add('notice', 'Atsakymas neisingas!');
        }
    }

    public function getNextQuestion()
    {
        return array('meridian_core_demo_question', array('gameId' => 1, 'questionId' => $this->nextQuestionId));
    }

    public function answerIsOk()
    {
        return $this->isOk;
    }

    public function getResponse($name, $parameters = [])
    {
        return new RedirectResponse($this->router->generate($name, $parameters));
    }

    public function getResponseForNextQuestion()
    {
        $q = $this->getNextQuestion();
        var_dump($this->nextQuestionId);
        if ($q['1']['questionId'] <= 3) {
            return $this->getResponse($q['0'], $q['1']);
        } else {
            return $this->getResponse('fos_user_registration_register');
        }
    }
}