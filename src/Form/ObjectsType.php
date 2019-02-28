<?php

namespace App\Form;

use App\Entity\Objects;
use App\Entity\Ressources;
use App\Entity\Machines;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ObjectsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => "Nom de l'objet",
                    'attr' => array('placeholder' => 'ex: Batterie moyenne'),
                ))
                ->add('ressourcesForObject', EntityType::class, array(
                    'class' => Ressources::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle(s) ressource(s) pour cet objet ?',
                    'multiple' => 'true',
                    'required' => false,
                ))
                ->add('machineWhoCreateObjects', EntityType::class, array(
                    'class' => Machines::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('e')
                                ->orderBy('e.id', 'ASC');
                    },
                    'choice_label' => 'name',
                    'label' => 'Quelle machine produit cet objet ?',
                    'required' => false,
                ))
                ->add('imageShowName', FileType::class, array(
                    'label' => 'Image fiche objet',
                    'required' => false,
                    'data_class' => null,
                ))
                ->add('imageIndexName', FileType::class, array(
                    'label' => 'Image objet',
                    'required' => false,
                    'data_class' => null,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Objects::class,
        ]);
    }

}
