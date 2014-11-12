<?php
/**
 * Created by PhpStorm.
 * User: darius
 * Date: 14.11.11
 * Time: 09.06
 */

namespace Meridian\CoreBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DemoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('answer');

    }
    public function getName()
    {
        return 'demo';
    }
} 