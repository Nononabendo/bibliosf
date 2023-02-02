<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                "constraints" => [
                    new NotNull(["message" => "Le titre ne peut pas être vide "])
                ]
            ])
            ->add('resume', TextareaType::class, [
                "label" => "Résumé"
            ])
            ->add('couverture')
            ->add('Auteur', EntityType::class, [
                "class"  =>  Auteur::class,
                "choice_label" => function ($auteur){
                    return $auteur->getPrenom() . " " . $auteur->getNom();
                },
                "placeholder" => "Choisissez un auteur..."
            ])
            ->add("genres", EntityType::class, [
                "class"        => Genre::class,
                "choice_label" => "libelle", // la propriété 'libelle' de la classe Genre sera utilisée pour l'affichage 
                "multiple"     => true,
                "expanded"     => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
