<?php

namespace App\Controller;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



class book_controller extends AbstractController
//initialisation des composants me permettant d'acceder
//au méthode requise
//héritage de ma classe -> acces méthode AC
{

    /**
     * initiation de la wild card avec ma route ( partie variable )
     * @Route ("/book/{id}", name="book")
     */
    //je donne a ma variable pour parmatre la wild card
    public function book($id)
    {
        $books = [
            1 => [
                "title" => "Dune",
                "image" => "https://www.thirdeditions.com/1522-large_default/les-visions-de-dune-dans-les-creux-et-sillons-d-arrakis.jpg",
                "author" => "Franck Herbert",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 1
            ],
            2 => [
                "title" => "Silo",
                "image" => "data:image/jpeg;base64,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",
                "author" => "Tery Hayes",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 2
            ],
            3 => [
                "title" => "Win",
                "image" => "https://www.elk-studios.com/wp-content/uploads/2019/07/win-special-e1563359523896.png",
                "author" => "Harlan Coben",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 3
            ],
            4 => [
                "title" => "La part de l'autre",
                "image" => "https://products-images.di-static.com/image/eric-emmanuel-schmitt-la-part-de-l-autre/9782253155379-475x500-1.jpg",
                "author" => "Éric-Emmanuel Schmitt",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 4
            ],
            5 => [
                "title" => "Snowman",
                "image" => "https://product-image.juniqe-production.juniqe.com/media/catalog/product/seo-cache/x800/680/50/680-50-101P/Snowman-Alex-Foster-Affiche.jpg",
                "author" => "Jo Nesbo",
                "publishedAt" => new \DateTime('NOW'),
                "id" => 5
            ]
        ];

        //iniatiation de ma condition afin de verifier si la wild card existe ou non
        if (!array_key_exists($id, $books))
        {
            //je crée un objet de la classe NotFoundHttpException afin d'afficher une erreur lorsque l'id demandé n'existe pas
            throw new NotFoundHttpException('Page_Not_Found');
        }
        //je profite du parametre de la méthode render me permettant de stocker une variable afin qu'elle soit accessible a Twig
        //grace au paramètre de la méthode render je stock mon tableau dans une variable accessible a Twig
        return $this->render('book_page.html.twig', ['book' => $books[$id]]);

    }

}