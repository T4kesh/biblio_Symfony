<?php

namespace App\Controller;

namespace App\Controller;
use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;


//je récupere mes composant da la librairie Smfony pour acceder a mes classes

class AuthorController extends AbstractController
{

    /**
     * @Route("author/create", name= "author_create")
     */
    //Auto Wyre partout sauf entity !Dommage!
    public function createAuthor()
    {
        //instanciation nouvel objet de classe auhtor cette foi ci ( toujours afin d'acceder au méthode de cette classe )
        $author = new Author();

        $author->setFirstName('Masashi');
        $author->setLastName('Kishimote');
        $author->setDeathDate(null);

        dump($author);die;
        //petit dump pour tester tout ça c'est gratuit

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