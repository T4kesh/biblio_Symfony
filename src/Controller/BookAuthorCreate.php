<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Author;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BookAuthorCreate
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

}