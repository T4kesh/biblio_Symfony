<?php

namespace App\Controller;
use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
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
     * Instanciation de la route ainsi que de ma wild card
     * @Route("book/update/{id}", name= "book_update")
     */

    //instacation de la classe BookR et EMI grace a l'auto wyre ( c'est lourd )
    public function bookUpdate($id, EntityManagerInterface $entityManager, BookRepository $bookRepository)
    {
        //instanciation de le objet book de classe book repository on accede donc au méthode de la classe
        //je recupere donc grace a la méthode find le book correspondant a l'id(la wild card) rentré dans lurl
        $book_update = $bookRepository->find($id);
        //j'effectue ensuite mes modifications grace au méthode de la classe bookRepository
        $book_update->setAuthor('Gucci Mane');
        $book_update->setTitle('Flexin in da hood');

        //la méthode persist instancié en auto wyre plus haut me permet de "pré sauvegarder" mes
        // modifications en lui donnant pour parametre ma variable book
       $entityManager->persist($book_update);
       //que j'envoi ensuiste en BDD grace a la méthode flush
        $entityManager->flush();

        return$this->render('book_update.html.twig');

    }

    /**

     * @Route("book/create", name= "book_create")
     */

    public function createBook(EntityManagerInterface $entityManager)
        //Auto Wyre de la classe EMI
    {
        //j'instancie mon nouvel objet ( book ) et accede ainsi a toutes les méthodes de la classe c'est lourd
        $book = new Book();
        // j'utilise ensuite les méthode de la classe pour définir les caractéristiques de mon objet de classe book

        $book->setTitle('Naruto');
        $book->setAuthor('Masashi Kishimoto');
        $book->setPublishedAt(new \DateTime('1999-10-04'));
        $book->setNbPage('187');
        //petit dump pour voir si tout c'est bien passé

        //Mon objet instancié me permet d'acceder au méthode de la classe EMI
        // $book  représente ici la donnée que je souhaite injecter en BDD je la met en "stand by" grace
        // a la méthode persist de classe EMI
        $entityManager->persist($book);
        //la méthode flush me permet de lancer mon injection en BDD ( sauvegarde) lorsque j'ai terminé d'instancié
        // les objets ( donnée ) que je souhaite save
        $entityManager->flush();

        //je retourne tout ça a ma view donc mon fichier twig grace a la méthode render ( classe AC)
        return$this->render('book_create.html.twig');

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