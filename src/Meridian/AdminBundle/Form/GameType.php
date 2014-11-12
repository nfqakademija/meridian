<?php

namespace Meridian\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('gamefoto')
            ->add('description')
            ->add('status');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('data_class'=>'Meridian\CoreBundle\Entity\Game'));
    }

    public function getName() {
        return 'meridian_corebundle_game';
    }
}