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

class AdminAuthorController extends AbstractController
{
    /**
     * création de ma wild card dans ma route
     * @Route("admin/author/remove/{id}", name= "admin_author_remove")
     */

    //je passe en parametre l'id de ma wild card ainsi que les classe nécéssaire a ma méthode afin qu'il soit instancié
    // AUTOMATIQUEMENT grace au goat symfony
    public function authorRemove($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        // grace a l'auto wyre j'accede donc a la méthode de AR me permettant de chercher l'auteur en BDD corespondant
        // a l'id (wild card) saisi dans l'url
        $author_remove = $authorRepository->find($id);

        //méthode remove de EMI qui me permet de delete ( pre-delete) ma donnée ( toujours basé sur l'id de la wild card)
        $entityManager->remove($author_remove);

        //on flush le tout quand le traitement en terminé grace a la méthode flush de la classe EMI je supprime
        // les donnée déja 'stocké' dans la méthode remove ( pas besoin de lui repasser en parametre ma variable contenant
        // ma donnée du coup
        $entityManager->flush();

        return$this->redirectToRoute('admin_author_list');

    }

    /**
     * Nouvelle route avec wild card
     * @Route("admin/author/update/{id}", name= "admin_author_update")
     */

    //j'auto wyre mes classe afin d'acceder au méthode nécéssaire au fonctionnement de ma méthode authorUpdate
    // je n'oublie pas de rentrer l'id ( wild card) aussi en parametre de celle-ci
    public function authorUpdate($id, AuthorRepository $authorRepository, EntityManagerInterface $entityManager)
    {
        //je recupere donc grace a la méthode find ici l'auteur correspondant a l'id(la wild card) rentré dans lurl
        $authorUpdate = $authorRepository->find($id);

        //j'accede au méthode de la classe author repository et procede a mes modification grace a elles
        $authorUpdate->setFirstName('Jean');
        $authorUpdate->setLastName('Dujardin');

        // je pré sauvegarde les "modifications grace a la méthode persist de EMI
        // en lui donnant pour parametre ma variable en cours de traitement
        $entityManager->persist($authorUpdate);
        //en j'injecte le tout une fois que j'ai fini mes modifactions grace a la méthode flush
        // toujours issu de la classe EMI
        $entityManager->flush();
        // pas besoin de lui donnée de parmatre vu qu'il se base sur la pré sauvegarde ( persist)
        // qui elle stock deja ma variable elle a donc déja été "pré enregistré"


        // je transmet tout ça a ma 'vue' donc le fichier twig
        // afin que la requete est une réponse html
        return$this->render('admin/author_update.html.twig');


    }

    /**
     * @Route("admin/author/create", name= "admin_author_create")
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
        return$this->render('admin/author_create.html.twig');

    }
    /**
     * création de ma route url
     * @Route("admin/author_list", name= "admin_author_list")
     */

    // On instancie un nouvel objet de la classe BOOKRepository en donnant
    // pour parmaetre a ma méthode variable et nom de classe
    public function authorListPage(AuthorRepository $authorRepository)
    {
        //grace a la méthode de la classe AR je sélectionne tout les auteurs de ma BDD
        // que je stock dans ma variable $authors
        $authors = $authorRepository->findAll();
        return$this->render('admin/author_list_page.html.twig', ['authors'=> $authors]);
    }

    /**
     * initialisation de ma wild card
     * @Route("admin/author{id}", name="admin_author")
     */

    public function  authorPage($id, AuthorRepository $authorRepository)
    {
        //methode find cette fois ci pour adapter la réponse en fonction de la wild card
        $author = $authorRepository->find($id);

        //utilisation de la méthode render de la classe AC afin de stocker mes donnée en les rendant accessible a twig
        return$this->render('admin/author_page.html.twig', ['author'=>$author]);
    }
}