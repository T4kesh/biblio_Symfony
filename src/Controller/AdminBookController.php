<?php

namespace App\Controller;
use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;



class AdminBookController extends AbstractController
//initialisation des composants me permettant d'acceder
//aux méthode requise
//héritage de ma classe -> acces méthode AC
{


    /**
     * initialisation de ma wil caard afin
     * @Route("admin/book/remove/{id}", name = "admin_book_remove")
     */
    //j'utilise l'autowyre de sy afin d'instancier mes classes et acceder a leur méthode
    // sans oublier de passer en parametre la wild card a ma méthode
    public function bookRemove($id, BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {

        //méthode fin de book repo me permet d'aller chercher la donnée ( livre ) en bdd coresspondant a l'id de la wild card
        $book_remove = $bookRepository->find($id);


        //méthode EMI me permettant la "pré sauvegarde" de ma manouevre ( ici suppréssion )
        $entityManager->remove($book_remove);

        //une fois les données que je souhaite supprimer j'effectue la suppréssion grace a la méthode flush
        // qui s'appliquera sur toutes les donées "stocké" précédement dans la méthode remove
        $entityManager->flush();

        //méthide de classe AC en faisant attention a donner le nom de la route pour la redirection et non
        // le nom de la page twig
        return$this->redirectToRoute('admin_list_book');


    }

    /**
     * @Route("admin/book/create", name= "admin_book_create")
     */

    public function createBook(Request $request, EntityManagerInterface $entityManager)
        //Auto Wyre de la classe EMI
    {
        //j'instancie mon nouvel objet ( book ) et accede ainsi a toutes les méthodes de la classe c'est lourd
        $book = new Book();

        //j utilise la méthode  create form AC afin de créer un formulaire
        // en utilisant la classe généré  BookType en ligne de commande : php bin/consolo make:form
        // je n'oublie pas de donner un parametre a la méthode CreateForm l'instance de l'intité book
        // autrement dire mon new objet généré grace a l'entité book $bppl
        $bookForm = $this->createForm(BookType::class, $book);

        //grace a la methode handleRequest de la classe request je lie, j'associe mon formulaire ( $bookform )
        // a ma requete , mon formulaire lui meme est associé a l'intité book afin que celui ci adapte ses imputs
        // au propiété ( ainsi qu'a leur type : int string ect) de celle ci ( entité book )
        $bookForm->handleRequest($request);


        //je procede a une vérification lors de l'envoi du formulaire ,en php classique if(!empty_POST est remplacé par une méthode
        // symfony de la classe request is Sumbitted ( assez explicite )
        // is valid prévient le fait d'avoir des données inseré avec un type incompatible a celui des colonne de ma table book en BDD
        // ainsi que les injections sql ( select * from admin ) et limite donc les agissements d'un utilisateur mal intentionné
        if ($bookForm->isSubmitted() && $bookForm->isValid())
        {
            // je réutilise mes méthode persist et flush de la classe EMI pour sauvegarder en BDD les données du formulaire

            //je met bien en parametre a ma méthode le formulaire ( associé a ma requete (lui meme associé a mon enité book précédement) )
            // faire attention a rentrer le bon parametre dans la méthode
            // ici $book et non $bookForm
            $entityManager->persist($book);
            //flush sauvegarde enfin les données présent dans la méthode persis en bdd
            $entityManager->flush();
        }



        // je transmet donc a ma vue (twig) ma variable contenant mon formulaire, etant un formulaire
        // j'utilise la méthode createView de AC por générer la vue de celui-ci sur mon fichier twig
        // sur mon fichier twig j'utilise la méthode {{ form }} afin d'afficher le formulaire généré
        return $this->render('admin/book_create.html.twig', [
            'bookForm' => $bookForm->createView()
            ]);

    }

    /**
     * initiation de la wild card avec ma route ( partie variable )
     * @Route ("admin/book/{id}", name="admin_book")
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
        return$this->render("admin/book_page.html.twig",['book' => $book]);
    }

    /**
     * @Route("admin/list_book", name="admin_list_book")
     */

    //meme procédé que ci dessus
    public function listBook(BookRepository $bookRepository)
    {
        //j'utilise ici la méthode findall de bookrepository afin d'acceder a tout le contenu de ma table
        $books = $bookRepository->findAll();
        //j u tilise le deuxieme parametre de la méthode AC afin de stocker "ma donnée" dans
        // une variable accessible a twig
        return$this->render("admin/list_book.html.twig", ['books'=> $books]);
    }





   ///////////////////////////////////////////////
    /// ////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////

    /**
     * Instanciation de la route ainsi que de ma wild card
     * @Route("admin/book/update/{id}", name= "admin_book_update")
     */

    //instacation de la classe BookR et EMI grace a l'auto wyre ( c'est lourd )
    // j'auto wyre la classe requete
    public function bookUpdate($id,Request $request,EntityManagerInterface $entityManager, BookRepository $bookRepository)
    {
        //instanciation de l objet book de classe book repository on accede donc au méthode de la classe
        //je recupere donc grace a la méthode find le book correspondant a l'id(la wild card) rentré dans lurl
        $bookUpdate = $bookRepository->find($id);

        //j utilise la méthode  create form AC afin de créer un formulaire
        // en utilisant la classe généré  BookType en ligne de commande : php bin/consolo make:form
        // je n'oublie pas de donner un parametre a la méthode CreateForm l'instance de l'intité book
        // autrement dire mon new objet généré grace a l'entité book ici $bookupdate
        $bookForm = $this->createForm(BookType::class, $bookUpdate);

        //grace a la methode handleRequest de la classe request j'associe mon formulaire ( $bookform )
        // a ma requete , mon formulaire lui meme etant associé a l'intité book afin que celui ci adapte ses imputs
        // au propiétés ainsi qu'a leur type : int string ect, de celle ci ( entité book ).
        $bookForm->handleRequest($request);


        //je procede a une vérification lors de l'envoi du formulaire ,en php classique if(!empty_POST est remplacé par une méthode
        // symfony de la classe request is Sumbitted ( assez explicite ) = verifie si mon form est bien rempli
        // is valid prévient le fait d'avoir des données inseré avec un type incompatible a celui des colonne de ma table book en BDD
        // ainsi que les injections sql ( select * from admin ) et limite donc les agissements d'un utilisateur mal intentionné
        if ($bookForm->isSubmitted() && $bookForm->isValid())
        {
            // je réutilise mes méthode persist et flush de la classe EMI pour sauvegarder en BDD les données du formulaire

            //je met bien en parametre a ma méthode le formulaire ( associé a ma requete,lui meme associé a mon enité book )
            // faire attention a rentrer le bon parametre dans la méthode
            // ici $book et non $bookForm
            $entityManager->persist($bookUpdate);
            //la méthode flush sauvegarde en BDD les données "pré sauvegardé" dans la méthode persist ci dessus
            $entityManager->flush();
        }



        // je transmet donc a ma vue (twig) ma variable contenant mon formulaire, etant un formulaire
        // j'utilise la méthode createView de AC por générer la vue de celui-ci sur mon fichier twig
        // sur mon fichier twig j'utilise la méthode {{ form }} afin d'afficher le formulaire
        // formulaire qui en se basant sur l'id, permettra d'acceder a la donnée correspondant
        // et d'ainsi la mettre a jour le livre lié a l'id (wild card) en remplissant le champs de celui ci.
        return $this->render('admin/book_update.html.twig', [
            'bookForm' => $bookForm->createView()
        ]);
    }
    /**
     * classique création de ma route
     * @Route("admin/search", name = "admin_search_books")
     */

    public function searchBooks(Request $request, BookRepository $bookRepository)
    {
        // je stock dans $word la recherche de l'utilisateur grace a la classe request

        $word = $request->query->get('q');
        // le q représente le formulaire ( la ou l'utilisateur rentrer les données qu'on récupere ici

        //la méthode crée dans mon book repositary et ici appélé afin de faire ma requete en bdd
        // basé sur la recherche de l'utilisateur ( ma méthode et doctrine effectuera la/les requetes sql necessaire a l'obtention
        // des données de la requetes utilisateur
        $books = $bookRepository->searchByTitle($word);

        // je retourne la vue de cette requete grace a ma page twig
        // tout en generant un variable accessible a twig me permettant d'acceder les livre de ma bdd
        return $this->render('admin/search_books.html.twig', [
            'books'=>$books
            ]);

    }


}