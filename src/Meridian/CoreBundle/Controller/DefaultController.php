<?php

namespace Meridian\CoreBundle\Controller;

use Meridian\CoreBundle\Entity\Questions;
use Meridian\CoreBundle\Entity\Answers;
use Meridian\CoreBundle\Entity\QuestionsRepository;
use Meridian\CoreBundle\Form\Type\QuestionAnswerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Meridian\CoreBundle\Form\Model\QuestionAnswer;
use Symfony\Component\Form;
use Meridian\CoreBundle\Service\QuestionAnswerService;

class DefaultController extends Controller
{
    public function indexAction($name,Request $request){

        $question_answer_services = $this->get('meridian_core.questionanswerservices');
        $form = $question_answer_services->createForm($request);
        return $this->render('MeridianCoreBundle:Default:tetst.html.twig', array('newform' => $form->createView()));


    }
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newFormForQuestionAction(Request $request)
    {


        $form = $this->createFormBuilder()
            ->add('question', new Questions())
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager()->getRepository('MeridianCoreBundle:Questions');
            $fill = $form -> getData();
            $em->persist($fill);
            $em->flush();
            return $this->redirect($this->generateUrl('meridian_core_questions'));
        }

        return $this->render('MeridianCoreBundle:Default:form.html.twig', array(
            'form'=>$form->createView(),
        ));
    }

    public function getAllQuestionsAction(){
        $questions = $this -> getDoctrine()
          ->getRepository('MeridianCoreBundle:Questions')
            ->findAll();
        //$answer = $questions -> getAnswers() -> getAnswer();
        //$questions = $this->getQuestionJoinedAnswer();
        //$one_answer = $this->getAnswerForQuestionAction('7');
        return $this->render('MeridianCoreBundle:Default:questions.html.twig', array('q4' => $questions));
    }
    public function getAnswerForQuestionAction($id){
        $answer = $this -> getDoctrine()
            ->getRepository('MeridianCoreBundle:Answers')
            ->find($id);
        $one_answer = $answer->getAnswer();
        return $one_answer;
    }

    public function removeOneQuestionAction($id){

        $em = $this -> getDoctrine() -> getManager();
        $question = $em -> getRepository('MeridianCoreBundle:Questions')
            ->find($id);
        $em -> remove($question);
        $em -> flush();
        return $this->redirect($this->generateUrl('meridian_core_questions'));

    }

    public function editQuestionAction($id , Request $request){

        $question = $this -> getDoctrine()
            ->getRepository('MeridianCoreBundle:Questions')
            ->find($id);

        $form = $this->createFormBuilder($question)
            ->add('question', 'text')
            ->add('questionFoto', 'text')
            ->add('description', 'text')
            ->add('Update', 'submit')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $question = $form -> getData();
            $em->persist($question);
            $em->flush();
            return $this->redirect($this->generateUrl('meridian_core_questions'));
        }

        //$serv = $this->getAllQuestionsAction();

        return $this->render('MeridianCoreBundle:Default:editform.html.twig', array(
          'form' => $form->createView(),
        ));
    }

    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('MeridianCoreBundle:Questions')
            ->find($id);

      $answer = $product->getAnswers()->getAnswer();

        return $this->render('MeridianCoreBundle:Default:tetst.html.twig',['testas'=>$answer]);
        // ...
    }
    public function getOneAction (){

        $t = $this->getDoctrine()->getRepository('MeridianCoreBundle:Game')
            ->find('1');
        $tt = $t->getQuestionss()->get;
    }

    public function getMainFormAction(){
        $form = $this->createFormBuilder(new QuestionAnswerType());
        $f = $form -> add('Siųsti','submit')
        ->getForm();
        //var_dump($f);
        return $this->render('MeridianCoreBundle:Default:tetst.html.twig',['newform'=>$f->createView()]);
    }

}
