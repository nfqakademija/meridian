<?php

namespace Meridian\CoreBundle\Service;
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.10
 * Time: 16.28
 */


use Meridian\CoreBundle\Form\Type\DemoType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;
use Meridian\CoreBundle\Entity;
use Symfony\Component\Form;

class demoServices{

    protected $question = '';
    protected $game = '';
    protected $answer = '';
    protected $form;
    protected $question_id;
    protected $next_question_id;
    protected $answer_from_form = array();
    protected $isOk=false;
    protected $session;

    public function __construct(EntityManager $entityManager, FormFactoryInterface $formFactory) {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function demo($game_id, $question_id)
    {
        $this->question_id = $question_id;
        $game = $this->em
            ->getRepository('MeridianCoreBundle:Game')
            ->find($game_id);
        $game_question_id = $this->em
            ->getRepository('MeridianCoreBundle:Questions')
            ->find($question_id);
        $question = $game_question_id->getQuestion();
        $this->question = $question;
        $this -> game = $game->getName();
        $answer = $game_question_id->getAnswers();
        $this->answer = $answer->getAnswer();
        return $this->question_id;
    }

    public function createAnswerForm(Request $request){
        $this->form = $this->formFactory->createBuilder(new DemoType())
            ->add('Siųsti', 'submit')
            ->getForm();
        $this->answer_from_form = $this->form->handleRequest($request)->getData();
        if($this->form->isValid())
        {
            $this->checkAnswer($this->answer,implode($this->answer_from_form),$request);
        }
        return $this->form;

    }
    //check if answer is correct
    public function checkAnswer($a1,$a2, Request $request){
        $session = $this->getSession($request);
        $a1 = strtolower($a1);
        $a2 = strtolower($a2);
        if($a1 == $a2){
            $session->getFlashBag()->add('notice', 'Atsakymas teisingas! Nesustok!');
            $this->isOk = true;
            $this->next_question_id = $this->question_id + 1;
        }
        else{
            $session->getFlashBag()->add('notice', 'Atsakymas neisingas!');
        }
    }
    public function getQuestion(){
        return $this->question;
    }

    public function getGameName(){
        return $this->game;
    }

    public function getNextQuestion(){
        return array('meridian_core_demo_question',array('game_id' => 1,'question_id'=>$this->next_question_id));
    }

    public function answerIsOk(){
        return $this->isOk;
    }
    public function getSession(Request $request){
        $this->session = $request->getSession();
        return $this->session;
    }
}