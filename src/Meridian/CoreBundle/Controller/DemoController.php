<?php

namespace Meridian\CoreBundle\Controller;

use Meridian\CoreBundle\Service\DemoService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form;

class DemoController extends Controller
{
    public function indexAction()
    {
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig', array(// ...
        ));
    }


    /**
     * @param string $gameId
     * @param string $questionId
     * @param Request $request
     * @return RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getDemoGameAction($gameId = '1', $questionId = '1', Request $request)
    {
        /** @var DemoService $demoService */
        $demoService = $this->get('meridian_core.demoservice');
        $demoService->getQuestionIdForGame($questionId);
        $form = $demoService->createAnswerForm($request);
        if ($demoService->answerIsOk())
        {
            return $demoService->getResponseForNextQuestion();
        }
        return $this->render('MeridianCoreBundle:Demo:demo.html.twig',
            ['answerForm' => $form->createView(), 'game' => $demoService->getGameName($gameId), 'question' => $demoService->getQuestionForGame($questionId)->getQuestion()]);
    }

}