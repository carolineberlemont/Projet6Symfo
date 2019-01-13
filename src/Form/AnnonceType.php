<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ApplicationType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnonceType extends ApplicationType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration ("Titre de votre annonce*", "Le titre de votre annonce"))
            ->add('slug', HiddenType::class)
            ->add(
                'birthDay', 
                IntegerType::class, 
                $this->getConfiguration ("Jour de naissance", "Jour (1 à 31)",[
                    'attr' => [
                        'min' => 1, 
                        'max' => 31
                    ]
                
                ])
            )
            ->add(
                'birthMonth', 
                IntegerType::class, 
                $this->getConfiguration("Mois de naissance", "1 à 12",[
                    'attr' => [
                        'min' => 1, 
                        'max' => 12 
                    ]
                ])
            )
            ->add('birthYear', IntegerType::class, $this->getConfiguration ("Année de naissance*", "ex: 1970",
            ['attr' => [
                'min' => 1900, 
                'max' => 2018 
                    ]
                ])
            )

            ->add('kind', ChoiceType::class, array('label' => 'Genre à la naissance*',
            'choices'  => array(
                'Féminin' => 0,
                'Masculin' => 1,
                'Indéfini' => 2)
            ))
            ->add('country', CountryType::class, array('label' => 'Pays de naissance*'))
            ->add('content', TextareaType::class, $this->getConfiguration ("Votre annonce*", "Détaillez votre recherche"));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
