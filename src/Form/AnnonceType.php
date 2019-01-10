<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnonceType extends AbstractType
{
    /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param [string] $label
     * @param [string] $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder) {
        return [
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ];    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration ("Titre*", "Le titre de votre annonce"))
            ->add('slug', HiddenType::class)
            ->add('birthDay', IntegerType::class, $this->getConfiguration ("Date de naissance", "Jour (1 à 31)"), array(
                'attr' => [
                    'min' => 1, 
                    'max' => 31,
                        ]))
            ->add('birthMonth', IntegerType::class, $this->getConfiguration ("Mois", "1 à 12"))
            ->add('birthYear', IntegerType::class, $this->getConfiguration ("Année*", "ex: 1970"))
            ->add('kind', ChoiceType::class, array('label' => 'Genre à la naissance*',
            'choices'  => array(
                'Féminin' => true,
                'Masculin' => false,)
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
