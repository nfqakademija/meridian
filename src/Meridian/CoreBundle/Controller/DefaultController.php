<?php

namespace Meridian\CoreBundle\Controller;

use Meridian\CoreBundle\Entity\Question;
use Meridian\CoreBundle\Entity\Answer;
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
          ->getRepository('MeridianCoreBundle:Question')
            ->findAll();
        return $this->render('MeridianCoreBundle:Default:questions.html.twig', array('q4' => $questions));
    }

    public function removeOneQuestionAction($id){

        $em = $this -> getDoctrine() -> getManager();
        $question = $em -> getRepository('MeridianCoreBundle:Question')
            ->find($id);
        $em -> remove($question);
        $em -> flush();
        return $this->redirect($this->generateUrl('meridian_core_questions'));

    }
    public function editQuestionAction($id , Request $request){

        $question = $this -> getDoctrine()
            ->getRepository('MeridianCoreBundle:Question')
            ->find($id);

        $form = $this->createFormBuilder($question)
            ->add('question', 'text')
            ->add('image', 'text')
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

        /** @var QuestionAnswerService $questionAnswerServices */
        $questionAnswerServices = $this->get('meridian_core.questionanswerservice');
        $form = $questionAnswerServices->createForm($request);
        return $this->render('MeridianCoreBundle:Default:form.html.twig', ['form' => $form->createView()]);
    }

/*    public function testQueryAction(){
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
    }*/
}
