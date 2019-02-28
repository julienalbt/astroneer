<?php

namespace App\Form;

use App\Entity\Planets;
use App\Entity\Ressources;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PlanetsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => 'Nom de la planète',
                    'attr' => array('placeholder' => 'ex: Sylva'),
                ))
                ->add('ressourcesOnPlanet', EntityType::class, array(
                    'class' => Ressources::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelles ressources sur la planète ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('imageShowName', FileType::class, array(
                    'label' => 'Image fiche planète',
                    'required' => false,
                    'data_class' => null,
                ))
                ->add('imageIndexName', FileType::class, array(
                    'label' => 'Image planète',
                    'required' => false,
                    'data_class' => null,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Planets::class,
        ]);
    }

}
