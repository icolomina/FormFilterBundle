<?php

namespace EasyFormFilterBundle\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class FormFilterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('filters');
        $resolver->setAllowedTypes('filters', '\Iterator');
    }

}