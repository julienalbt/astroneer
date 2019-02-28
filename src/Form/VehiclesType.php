<?php

namespace App\Form;

use App\Entity\Vehicles;
use App\Entity\Ressources;
use App\Entity\Machines;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VehiclesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => 'Nom du véhicule',
                    'attr' => array('placeholder' => 'ex: Rover'),
                ))
                ->add('ressourcesForVehicle', EntityType::class, array(
                    'class' => Ressources::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle(s) ressource(s) pour ce véhicule ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('machineWhoCreateVehicles', EntityType::class, array(
                    'class' => Machines::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle machine produit ce véhicule ?',
                    'required' => false,
                ))
                ->add('imageShowName', FileType::class, array(
                    'label' => 'Image fiche véhicule',
                    'required' => false,
                    'data_class' => null,
                ))
                ->add('imageIndexName', FileType::class, array(
                    'label' => 'Image véhicule',
                    'required' => false,
                    'data_class' => null,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Vehicles::class,
        ]);
    }

}
