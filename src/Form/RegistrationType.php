<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationType extends ApplicationType
{   

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, $this->getConfiguration("Prénom", "Votre prénom ..."))
            ->add('lastName', TextType::class, $this->getConfiguration("Nom", "Votre nom de famille ..."))
            ->add('email', EmailType::class, $this->getConfiguration("Email", "Votre adresse email"))
            ->add('hash', PasswordType::class, $this->getConfiguration("Mot de passe", "Choississez un mot de passe que vous n'oublierez jamais !"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation de mot de passe", "Veuillez confirmer votre mot de passe"))
            ->add('presentation', TextareaType::class, $this->getConfiguration("Présentation", "Présentez-vous aux autres utilisateurs du site"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
