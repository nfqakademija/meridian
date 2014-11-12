<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.11
 * Time: 14.09
 */

namespace Meridian\CoreBundle\Service;
use Meridian\CoreBundle\Form\Model\QuestionAnswer;
use Symfony\Component\Form\FormFactoryInterface;
use Doctrine\ORM\EntityManager;
use Meridian\CoreBundle\Form\Type\QuestionAnswerType;
use Symfony\Component\HttpFoundation\Request;
use Meridian\CoreBundle\Entity;
use Symfony\Component\Form;

class QuestionAnswerService {

    protected $question_answer_form;

    public function __construct(EntityManager $entityManager, FormFactoryInterface $formFactory) {
        $this->em = $entityManager;
        $this->formFactory = $formFactory;
    }
    //sukuriama forma klausimo ir atsakymo įvedimui
    public function createForm(Request $request){
        $question_answer = new QuestionAnswer();
        $this->question_answer_form = $this->formFactory->createBuilder(new QuestionAnswerType(),$question_answer)
            ->add('Add', 'submit')
            ->getForm();
        $form = $this->question_answer_form;
        $form_data = $this->question_answer_form->handleRequest($request)->getData();
        var_dump($form_data->answer);
        if ($form->isValid()) {
            echo 'ok';
            //$form_data->answer->flush();
            $em = $this->em;
            $em->persist($form_data->answer);
            //$em->flush();
            var_dump($this->em->getConnection()->lastInsertId());
            var_dump($form_data->answer->getId());
            $form_data->question->setAnswers($form_data->answer);
            var_dump($form_data->question->getAnswerId());
            $em->persist($form_data->question);
            $em->flush();
            //$form_data->answer->setAnswer();

           // $this->em->persist($form_data->answer)->flush();
        }
        else{
            echo "darai nesamones:)";
        }
    return $this->question_answer_form;
    }

} 