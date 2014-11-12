<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.11
 * Time: 09.54
 */

namespace Meridian\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionAnswerType extends  AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', new QuestionType())
            ->add('answer', new AnswerType());
    }
    public function getName()
    {
        return 'questionanswer';
    }
}