<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    //suprimer l'auter pour éviter des problemes de conversion ( 20min pour trouver le bug) jpp
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nb_page')
            ->add('published_at')
            // comme pour le boutton valider je donne a symfony l'information que
            // que l'imput author est de type Entité,
            ->add('author', EntityType::class, [
                // j'attribut a la clé class l'entité Author
                'class'=> Author::class,
                //dans la clé 'choice label' j'instancie mon entité AUTHOR ( $author )
                'choice_label' => function ($author) {
                //ce qui me permet d'acceder au geter de celui ci et me permet par la suite
                // d'acceder a la collone First et Last name de l'entité author
                // et ainsi d'afficher dans l'imput author de mon form le nom et prenom des author présent en bdd
                    return $author->getFirstName() . ' ' . $author->getLastName();
                }
            ] )
            //je crée mon boutton valider en précisant bien sont type car non dépendant des propriété de l'entité book
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
