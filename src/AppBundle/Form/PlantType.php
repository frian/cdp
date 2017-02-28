<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class PlantType extends AbstractType
{

    // const MONTHS = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $months = ['jan' => 1, 'fév' => 2, 'mars' => 3, 'avril' => 4, 'mai' => 5, 'juin' => 6, 'juil' => 7, 'aou' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'déc' => 12];

        $builder
            ->add('name')
            ->add('soil', EntityType::class, array(
                'class'    => 'AppBundle:Soil',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('seedsQuantity')
            ->add('seedsQuantityUnit', EntityType::class, array(
                'class'    => 'AppBundle:SeedsQuantityUnit',
            ))
            ->add('seedingDepth')
            ->add('lineDistance')
            ->add('lineInterval')
            ->add('watering', EntityType::class, array(
                'class'    => 'AppBundle:Watering',
                'expanded' => true,
            ))
            ->add('underCoverStart', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true,
                'choice_value' => function ($choice) {
                    return $choice;
                },
            ))
            ->add('underCoverEnd', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('inGroundStart', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('inGroundEnd', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('plantingStart', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('plantingEnd', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('harvestStart', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('harvestEnd', ChoiceType::class, array(
                'choices' => $months,
                'expanded' => true
            ))
            ->add('timeToSprout')
            ->add('timeToHarvest')
            ->add('friendlyPlants', EntityType::class, array(
                'class'    => 'AppBundle:Plant',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('enemyPlants', EntityType::class, array(
                'class'    => 'AppBundle:Plant',
                'expanded' => true,
                'multiple' => true
            ))
            ->add('tips');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Plant'
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
