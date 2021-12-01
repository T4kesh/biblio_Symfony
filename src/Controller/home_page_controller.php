<?php

namespace App\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class home_page_controller extends AbstractController
// j extends abstract controller afin d acceder a ses méthodes
// initialisation de mes classe Route et abstract controller grace aux composants de la librairie
// Symfony Route/AbstractController
{
    /**
     * @Route("/", name="home")
     * Création de ma page grace a la méthode Route
     */

    public function home_page()
    {
        //j'utilise la méthode render afin d'afficher (ma view) cad le resultat de la requete sou forme d'html
        //grace au fichier twig
        return $this->render('home_page.html.twig');

    }
}