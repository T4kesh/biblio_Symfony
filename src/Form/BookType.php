<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    //suprimer l'auter pour éviter des problemes de conversion ( 20min pour trouver le bug) jpp
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nb_page')
            ->add('title')
            ->add('published_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
