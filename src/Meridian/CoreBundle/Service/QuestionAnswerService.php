<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.11
 * Time: 14.09
 */

namespace Meridian\CoreBundle\Service;

use Meridian\CoreBundle\Form\Model\QuestionAnswer;
use Meridian\CoreBundle\Form\Type\QuestionType;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;
use Meridian\CoreBundle\Form\Type\QuestionAnswerType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Meridian\CoreBundle\Entity;
use Symfony\Component\Form;

class QuestionAnswerService
{

    protected $questionAnswerForm;

    public function __construct(EntityManager $entityManager, FormFactoryInterface $formFactory)
    {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function createForm(Request $request)
    {
        $questionAnswer = new QuestionAnswer();
        $this->questionAnswerForm = $this->formFactory->createBuilder(new QuestionAnswerType(), $questionAnswer)
            ->add('Add', 'submit')
            ->getForm();
        $form = $this->questionAnswerForm;
        $form_data = $this->questionAnswerForm->handleRequest($request)->getData();
        if ($form->isValid()) {
            $em = $this->em;
            $em->persist($form_data->answer);
            $form_data->question->setAnswer($form_data->answer);
            $em->persist($form_data->question);
            $em->flush();
        }
        return $this->questionAnswerForm;
    }

    public function getAllQuestions()
    {
        return $this->em->getRepository('MeridianCoreBundle:Question')->findAll();
    }

    public function removeOneQuestion($id)
    {
        $question = $this->em->getRepository('MeridianCoreBundle:Question')->find($id);
        $this->em->remove($question);
        $this->em->flush();
    }

    public function getQuestionEditForm($id)
    {
        return $this->formFactory->createBuilder(new QuestionType(), $this->getRepositoryForQuestionEdit($id))
            ->add('Update', 'submit')
            ->getForm();
    }

    public function getRepositoryForQuestionEdit($id)
    {
        return $this->em->getRepository('MeridianCoreBundle:Question')->find($id);
    }
} 