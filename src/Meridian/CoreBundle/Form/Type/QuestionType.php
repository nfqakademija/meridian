<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.10
 * Time: 18.59
 */

namespace Meridian\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question')
            ->add('description')
            ->add('questionFoto');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Meridian\CoreBundle\Entity\Questions'
        ));
    }

    public function getName()
    {
        return 'question';
    }
}