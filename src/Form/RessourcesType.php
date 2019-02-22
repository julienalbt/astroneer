<?php

namespace App\Form;

use App\Entity\Ressources;
use App\Entity\Vehicles;
use App\Entity\Objects;
use App\Entity\Machines;
use App\Entity\Planets;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RessourcesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => 'Nom de la ressource',
                    'attr' => array('placeholder' => 'ex: wolframite'),
                ))
                ->add('whatPlanets', EntityType::class, array(
                    'class' => Planets::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Se trouve sur quelle(s) planète(s) ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('whatVehicles', EntityType::class, array(
                    'class' => Vehicles::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Pour construire quel(s) véhicule(s) ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('whatObjects', EntityType::class, array(
                    'class' => Objects::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Pour construire quel(s) objet(s) ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('whatMachines', EntityType::class, array(
                    'class' => Machines::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Pour construire quelle(s) machine(s) ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('imageFile', VichImageType::class, [
                    'label' => 'Image de la ressource',
                    'required' => false,
                    'allow_delete' => true,
                    'download_label' => false,
                    'download_uri' => false,
                    'image_uri' => false,
                ])
                ->add('origin', ChoiceType::class, array(
                    'label' => 'Provenance',
                    'choices' => array(
                        'minage' => 'minage',
                        'fusion' => 'fusion',
                        'condensation atmosphérique' => 'condensation atmosphérique',
                        'chimie' => 'chimie',
                    ),
                ))
                ->add('ressourcesForRessource', EntityType::class, array(
                    'class' => Ressources::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Pour produire quelle(s) ressource(s) ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Ressources::class,
        ]);
    }

}
