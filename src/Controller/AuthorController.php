<?php

namespace App\Controller;

namespace App\Controller;
use App\Entity\Author;
use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;


//je récupere mes composant da la librairie Smfony pour acceder a mes classes

class AuthorController extends AbstractController
{


    /**
     * Nouvelle route avec wild card
     * @Route("author/update/{id}", name= "author_update")
     */

    //j'auto wyre mes classe afin d'acceder au méthode nécéssaire au fonctionnement de ma méthode authorUpdate
    // je n'oublie pas de rentrer l'id ( wild card) aussi en parametre de celle-ci
    public function authorUpdate($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        //je recupere donc grace a la méthode find ici l'auteur correspondant a l'id(la wild card) rentré dans lurl
        $author_update = $authorRepository->find($id);

        //j'accede au méthode de la classe author repository et procede a mes modification grace a elles
        $author_update->setFirstName('Jean');
        $author_update->setLastName('Dujardin');

        // je pré sauvegarde les "modifications grace a la méthode persist de EMI
        // en lui donnant pour parametre ma variable en cours de traitement
        $entityManager->persist($author_update);
        //en j'injecte le tout une fois que j'ai fini mes modifactions grace a la méthode flush
        // toujours issu de la classe EMI
        $entityManager->flush();
        // pas besoin de lui donnée de parmatre vu qu'il se base sur la pré sauvegarde ( persist)
        // qui elle stock deja ma variable elle a donc déja été "pré enregistré"


        // je transmet tout ça a ma 'vue' donc le fichier twig
        // afin que la requete est une réponse html
        return$this->render('author_update.html.twig');


    }

    /**
     * @Route("author/create", name= "author_create")
     */
    //Auto Wyre partout sauf entity !Dommage!
    public function createAuthor(EntityManagerInterface $entityManager)
        //j'instancie grace à l'auto wyre mon inter-classe EntityManager
        // en rentrant pour parametre a ma variable le nom de l'inter-classe et la variable
    {
        //instanciation nouvel objet de classe auhtor cette foi ci ( toujours afin d'acceder au méthode de cette classe )
        $author = new Author();

        $author->setFirstName('Masashi');
        $author->setLastName('Kishimote');
        $author->setDeathDate(null);

        //la méthode persist de l'inter classe EM me permet de prépare l'injection (la sauvegarde) de ma classe en BDD
        $entityManager->persist($author);
        //la méthode flush applique ensuite la sauvegarde de tout mes objets en bdd en stand by
        //de la méthode persist ( je "stock" les objets que je souhaite injecter en bdd puis les injecte quand j'ai terminé
        //grace a la méthode flush)
        $entityManager->flush();
        return$this->render('author_create.html.twig');

    }
    /**
     * création de ma route url
     * @Route("/author_list", name= "author_list")
     */

    // On instancie un nouvel objet de la classe BOOKRepository en donnant
    // pour parmaetre a ma méthode variable et nom de classe
    public function authorListPage(AuthorRepository $authorRepository)
    {
        //grace a la méthode de la classe AR je sélectionne tout les auteurs de ma BDD
        // que je stock dans ma variable $authors
        $authors = $authorRepository->findAll();
        return$this->render('author_list_page.html.twig', ['authors'=> $authors]);
    }

    /**
     * initialisation de ma wild card
     * @Route("/author{id}", name="author")
     */

    public function  authorPage($id, AuthorRepository $authorRepository)
    {
        //methode find cette fois ci pour adapter la réponse en fonction de la wild card
        $author = $authorRepository->find($id);

        //utilisation de la méthode render de la classe AC afin de stocker mes donnée en les rendant accessible a twig
        return$this->render('author_page.html.twig', ['author'=>$author]);
    }
}