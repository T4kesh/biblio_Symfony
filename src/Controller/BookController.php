<?php

namespace App\Controller;
use App\Entity\Book;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;



class BookController extends AbstractController
//initialisation des composants me permettant d'acceder
//aux méthode requise
//héritage de ma classe -> acces méthode AC
{

    /**
     * @Route("book/create", name= "book_create")
     */

    public function createBook()
    {
        //j'instancie mon nouvel objet ( book ) et accede ainsi a toutes les méthodes de la classe c'est lourd
        $book = new Book();
        // j'utilise ensuite les méthode de la classe pour définir les caractéristiques de mon objet de classe book

        $book->setTitle('Naruto');
        $book->setAuthor('Masashi Kishimoto');
        $book->setPublishedAt(new \DateTime('1999-10-04'));
        $book->setNbPage('187');
        //petit dump pour voir si tout c'est bien passé

        dump($book);die;

    }

    /**
     * initiation de la wild card avec ma route ( partie variable )
     * @Route ("/book/{id}", name="book")
     */

    //j'instancie mon objet en donnant pour parametre ma classe
    // et l'objet instancié ( le nom choisi peut etre modifié ici $bookrepository)
    public function book($id, BookRepository $bookRepository)
    {
        //je stock ma donnée dans la meme variable que précédement afin de pouvoir l'utiliser
        // dans me différentess méthode

        // je donne m=pour parametre a ma méthode find l $id afin que la requete
        // s'adapte toujours en fonction la wild card
        $book = $bookRepository->find($id);
        return$this->render("book_page.html.twig",['book' => $book]);
    }


    /**
     * @Route("/list_book", name="list_book")
     */

    //meme procédé que ci dessus
    public function listBook(BookRepository $bookRepository)
    {
        //j'utilise ici la méthode findall de bookrepository afin d'acceder a tout le contenu de ma table
        $books = $bookRepository->findAll();
        //j u tilise le deuxieme parametre de la méthode AC afin de stocker "ma donnée" dans
        // une variable accessible a twig
        return$this->render("list_book.html.twig", ['books'=> $books]);
    }

}