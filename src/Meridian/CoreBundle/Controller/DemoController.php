<?php

namespace Meridian\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Meridian\CoreBundle\Entity\Game;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form;
class DemoController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig', array(
            // ...
        ));    }
    public function startGameAction(){
        $game = $this->getDoctrine()
            ->getRepository('MeridianCoreBundle:Game')
            ->find('1');
        $game_name = $game->getName();
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig', ['game_name'=>$game_name]);
    }
    public function getQuestionByGameIdAction($game_id){
        $game = $this->getDoctrine()
            ->getRepository('MeridianCoreBundle:Game')
            ->find($game_id);
        $questions_for_game = $game-> getQuestionss()->getValues();
        $te = implode(' ',$questions_for_game);

       /** $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('MeridianCoreBundle:Questions')
            ->getOneQuestionForGame();
        //echo $products;
**/
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig', ['all'=>$te]);
        /**$question = $this -> getDoctrine()
        ->getRepository('MeridianCoreBundle:Questions')
        ->find($question_id);
        $answer = $question ->getAnswers()
            ->getAnswer();**/
        //$game_question  = $game -> getQuestionss(); //game_question saugo sujungimą tarp lentelių
        //$game_question = $this->getDoctrine()
          // ->getRepository('MeridianCoreBundle:Questions')
           //->findAll();
        /** $game_name = $game -> getName();
        $g = $game_question_id ->getQuestion();
        $answers =  $game_question_id ->getAnswers();
        $answers_name = $answers->getAnswer();
        $answer_id = $answers->getId();**/

        //return $this->render('MeridianCoreBundle:Demo:demo.html.twig', ['game_name'=>$g,'answer'=>$answers_name,'game'=>$game_name]);
    }
    public function getDemoGameAction($game_id='1', $question_id='1', Request $request){

        $demo_services = $this->get('meridian_core.demoservices');
        $demo_services->demo($game_id, $question_id);
        $game = $demo_services->getGameName();
        $question = $demo_services->getQuestion();
        $form = $demo_services->createAnswerForm($request);
        if($demo_services->answerIsOk()){
            $q = $demo_services->getNextQuestion();
            var_dump($q['1']['question_id']);
            if($q['1']['question_id'] <= 3) {
                return $this->redirect($this->generateUrl($q['0'],$q['1']));
            }
            else{
                return $this->redirect($this->generateUrl('fos_user_registration_register'));
            }

        }
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig',['answer_form'=>$form->createView(),'game' => $game, 'question'=>$question]);
    }
}