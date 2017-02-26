<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class plantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('soil', null, array('expanded' => true, 'multiple' => true))
            ->add('seedsQuantity')
            ->add('seedsQuantityUnit')
            ->add('seedingDepth')
            ->add('lineDistance')
            ->add('lineInterval')
            ->add('watering')
            ->add('underCoverStart')
            ->add('underCoverEnd')
            ->add('inGroundStart')
            ->add('inGroundEnd')
            ->add('plantingStart')
            ->add('plantingEnd')
            ->add('harverstStart')
            ->add('harvestEnd')
            ->add('friendlyPlants')
            ->add('enemyPlants')
            ->add('tips');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\plant'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_plant';
    }


}
