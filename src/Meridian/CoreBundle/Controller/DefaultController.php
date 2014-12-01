<?php

namespace Meridian\CoreBundle\Controller;

use Meridian\CoreBundle\Entity\Game;
use Meridian\CoreBundle\Entity\GameQuestion;
use Meridian\CoreBundle\Entity\Question;
use Meridian\CoreBundle\Entity\Answer;
use Meridian\CoreBundle\Service\QuestionAnswerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        return $this->render('MeridianCoreBundle:Default:form.html.twig', array('name' => $name));
    }

    public function getAllQuestionsAction()
    {
        $allQuestion = $this->get('meridian_core.question_answer_service');
        return $this->render('MeridianCoreBundle:Default:questions.html.twig',
            ['q4' => $allQuestion->getAllQuestions()]);
    }

    public function removeOneQuestionAction($id)
    {
        $removeOneQuestion = $this->get('meridian_core.question_answer_service');
        $removeOneQuestion->removeOneQuestion($id);
        return $this->redirect($this->generateUrl('meridian_core_questions'));
    }

    public function editQuestionAction($id, Request $request)
    {
        $editQuestion = $this->get('meridian_core.question_answer_service');
        $form = $editQuestion->getQuestionEditForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();
            return new RedirectResponse('/questions');
        }
        return $this->render('MeridianCoreBundle:Default:editform.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAnswerAction($id, Request $request)
    {

        $question = $this->getDoctrine()
            ->getRepository('MeridianCoreBundle:Answer')
            ->find($id);

        $form = $this->createFormBuilder($question)
            ->add('answer', 'text')
            ->add('description', 'text')
            ->add('image', 'text')
            ->add('Update', 'submit')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $question = $form->getData();
            $em->persist($question);
            $em->flush();
            return $this->redirect($this->generateUrl('meridian_core_questions'));
        }
        return $this->render('MeridianCoreBundle:Default:AnswerEditForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMainFormAction(Request $request)
    {

        /** @var QuestionAnswerService $questionAnswerService */
        $questionAnswerService = $this->get('meridian_core.question_answer_service');
        $form = $questionAnswerService->createForm($request);
        return $this->render('MeridianCoreBundle:Default:form.html.twig', ['form' => $form->createView()]);
    }

    /**
     * this function start game
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function startGameAction(Request $request)
    {
        $game = $this->get('meridian_core.game_service');
        $game->getUserInfo($this->getUser());
        $game->returnToGame($request);
        $form = $game->createAnswerForm($request);
        if ($game->answerIsOk()) {
            return new RedirectResponse('game');
        }
        if($game->getPositionInGame() == 11 && $game->checkGame($game->getGameId()) || $game->checkQuestions($request)!=10)
        {
            return $this->render('MeridianCoreBundle:Default:game.html.twig',
                [
                    'question' => '',
                    'game' => '',
                    'answerForm' => $game->emptyForm()->createView(),
                    'level' => $game->getUserLevel(),
                    'scores' => $game->getUserScores()
                ]);
        }
        else
        {
            return $this->render('MeridianCoreBundle:Default:game.html.twig',
                [
                    'question' => 'Klausimas: '.$game->getQuestionForGame($request),
                    'game' => $game->getGameName(),
                    'answerForm' => $form->createView(),
                    'level' => $game->getUserLevel(),
                    'scores' => $game->getUserScores()
                ]);
        }
    }
}
