<?php

namespace Meridian\CoreBundle\Controller;

use Meridian\CoreBundle\Entity\Questions;
use Meridian\CoreBundle\Entity\Answers;
use Meridian\CoreBundle\Service\QuestionAnswerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form;

class DefaultController extends Controller
{
    public function indexAction($name){

        return $this->render('MeridianCoreBundle:Default:form.html.twig', array('name' => $name));
    }

    public function getAllQuestionsAction(){
        $questions = $this -> getDoctrine()
          ->getRepository('MeridianCoreBundle:Questions')
            ->findAll();
        return $this->render('MeridianCoreBundle:Default:questions.html.twig', array('q4' => $questions));
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

    public function editAnswerAction($id , Request $request){

        $question = $this -> getDoctrine()
            ->getRepository('MeridianCoreBundle:Answers')
            ->find($id);

        $form = $this->createFormBuilder($question)
            ->add('answer', 'text')
            ->add('description', 'text')
            ->add('answerfoto', 'text')
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
        return $this->render('MeridianCoreBundle:Default:AnswerEditForm.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function getMainFormAction(Request $request){

        /** @var QuestionAnswerService $question_answer_services */
        $question_answer_services = $this->get('meridian_core.questionanswerservice');
        $form = $question_answer_services->createForm($request);
        return $this->render('MeridianCoreBundle:Default:form.html.twig', ['form' => $form->createView()]);
    }

    public function testQueryAction(){
        $repository = $this->getDoctrine()
            ->getRepository('MeridianCoreBundle:Game');

        $query = $repository->createQueryBuilder('g')
            ->select('q.question')
            ->from('MeridianCoreBundle:Questions', 'q')
            ->innerJoin('q.game', 'qq')
            ->where('q.id =2')
            ->getQuery();
        $q = $query->getResult();
        var_dump($q);
        return $this->render('MeridianCoreBundle:Default:test.html.twig', ['q' => $q]);
    }
}
