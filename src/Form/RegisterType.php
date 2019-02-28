<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => "Nom d'utilisateur",
                'attr' => array('placeholder' => "ex: Beber"),
            ))
            ->add('email', EmailType::class, array(
                'label' => "Email",
                'attr' => array('placeholder' => "ex: Beber@gmail.com"),
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Répéter le password'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Model\Users',
        ]);
    }
}
