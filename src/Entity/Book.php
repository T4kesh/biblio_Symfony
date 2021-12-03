<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
//composante nécéssaire a l'utilisatio  de méthode de la classe orm

/**
 * @ORM\Entity()
 */

class Book
{
    /**
     * création des propriété de ma demande de création de table ( ceci est une annotations)
     * grace a orm je donne les parmatres souhaité
     * a mon id grace a cette methode
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */

    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */

    private $author;

    /**
     * @ORM\Column(type="integer")
     */


    /**
     * @ORM\Column(type="datetime")
     */
    private $published_at;


    /**
     * object relationel mapping
     * @ORM\Column(type="integer")
     */

    private $nb_page;
}

