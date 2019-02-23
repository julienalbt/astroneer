<?php

namespace App\Form;

use App\Entity\Machines;
use App\Entity\Ressources;
use App\Entity\Objects;
use App\Entity\Vehicles;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MachinesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => 'Nom de la machine',
                    'attr' => array('placeholder' => 'ex: Imprimante petite'),
                ))
                ->add('ressourcesForMachine', EntityType::class, array(
                    'class' => Ressources::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelles ressources pour cette machine ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('machineWhoCreateMachines', EntityType::class, array(
                    'class' => Machines::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle machine produit cette machine ?',
                    'required' => false,
                ))
                ->add('objectsByMachine', EntityType::class, array(
                    'class' => Objects::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quel(s) objet(s) sont construit par cette machine ?',
                    'multiple' => true,
                    'required' => false,
                ))
                ->add('vehiclesByMachine', EntityType::class, array(
                    'class' => Vehicles::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quel(s) véhicule(s) sont construit par cette machine ?',
                    'multiple' => true,
                    'required' => false,
                ))
                ->add('machinesByMachine', EntityType::class, array(
                    'class' => Machines::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle(s) machine(s) sont construite par cette machine ?',
                    'multiple' => true,
                    'required' => false,
                ))
                ->add('imageFile', VichImageType::class, [
                    'label' => 'Image de la machine',
                    'required' => false,
                    'allow_delete' => true,
                    'download_label' => false,
                    'download_uri' => false,
                    'image_uri' => false,
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Machines::class,
        ]);
    }

}
