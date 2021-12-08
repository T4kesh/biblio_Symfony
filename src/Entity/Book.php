<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
/**
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass=BookRepository::class)
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
     * @ORM\Column(type="datetime")
     */
    private $published_at;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }



    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->published_at;
    }

    /**
     * @param mixed $published_at
     */
    public function setPublishedAt($published_at): void
    {
        $this->published_at = $published_at;
    }

    /**
     * @return mixed
     */
    public function getNbPage()
    {
        return $this->nb_page;
    }

    /**
     * @param mixed $nb_page
     */
    public function setNbPage($nb_page): void
    {
        $this->nb_page = $nb_page;
    }


    /**
     * object relationel mapping
     * @ORM\Column(type="integer")
     */

    private $nb_page;

    /**
     * grace a la propiété de ManyToOne je join mon entité book a l'entité auteur
     * cette fonction me permet de faire executer a symfony la raequete sql normalement nécéssaire a executer
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */


    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }


}

