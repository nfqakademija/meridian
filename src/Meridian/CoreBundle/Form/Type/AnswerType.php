<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.10
 * Time: 19.02
 */

namespace Meridian\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnswerType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer')
            ->add("description")
            ->add('answerfoto');
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meridian\CoreBundle\Entity\Answers'
        ));
    }
    public function getName()
    {
        return 'answer';
    }
}