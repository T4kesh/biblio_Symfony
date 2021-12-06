<?php


namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;

class home_page_controller extends AbstractController
// j extends abstract controller afin d acceder a ses méthodes
// initialisation de mes classe Route et abstract controller grace aux composants de la librairie
// Symfony Route/AbstractController
{
    /**
     * @Route("/", name="home")
     * Création de ma page grace a la méthode Route
     */

    // je me sers ici de la classe book repository afin d'acceder au méthode me permettant d'interagir
    // avec ma basse de données
    // je donne donc , afin d'instancier ma classe pour parametre a ma méthode le nom de la classe
    // ainsi que le nom que le nouvelle objet portera $bookrepository
    public function home_page(BookRepository $bookRepository)
    {
        //je stopck ma donné dans une variable que j'utilise par la suite avec les meme procédé précendent
        //j'utilise la méthode findby afin de séléctionner les 3 derniers element dans mon tableau
        // que jenvoi ensuite dans ma page twig apres l'avoir stocké dans une variable
        $books = $bookRepository->findBy(array(),array('id' => 'DESC'),3,0);

        return $this->render("home_page.html.twig", ['books'=> $books]);

    }

}