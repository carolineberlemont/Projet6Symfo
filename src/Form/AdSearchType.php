<?php

namespace App\Form;

use App\Entity\AdSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AdSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthYear', IntegerType::class, [ 
            'required' => false, 
            'label' => false,
            'attr' => [
                'min' => 1900, 
                'max' => 2019,
                'placeholder' => 'Année de naissance'
                ]
            ])

            ->add('birthMonth', IntegerType::class, [ 
                'required' => false, 
                'label' => false,
                'attr' => [
                    'min' => 1, 
                    'max' => 12,
                    'placeholder' => 'Mois de naissance'
                ]
                ])

            ->add('birthDay', IntegerType::class, [ 
                'required' => false, 
                'label' => false,
                'attr' => [
                    'min' => 1, 
                    'max' => 31,
                    'placeholder' => 'Jour de naissance'
                ]
                ])

            ->add('kind', ChoiceType::class, array('label' => false,
            'choices'  => array(
                'Féminin' => 'Féminin',
                'Masculin' => 'Masculin',
                'Inconnu' => 'Inconnu')
            ))

            ->add('country', CountryType::class, array( 'label' => false,
            'preferred_choices' => array('FR'), 
            'choice_translation_locale' => null
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdSearch::class,
            'method' => 'get'
        ]);
    }

    //cette fonction devrait permettre de retourner un url de recherche vide mais ca ne fonctionne pas
    public function getBlockPrefix() {
        return '';
    }
}
