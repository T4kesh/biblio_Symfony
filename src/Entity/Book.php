<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use phpDocumentor\Reflection\Types\Nullable;

/**
 * @ORM\Entity()
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */

class Book
{

    /**
     * object relationel mapping
     * @ORM\Column(type="integer")
     */
    private $nb_page;

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
     * Jointure sql généré par symfony
     * Manytoone car plusiseurr books peuvent etre lié a un seul author
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     * Faire attention lors de la génération de la jointure en ligne de commande
     * ( make:entity) a bien nommer ( avec ou sans maj ) les entité et nom de classe!
     */
    private $Author;


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


    public function getGenre(): ?book
    {
        return $this->genre;
    }

    public function setGenre(?book $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->Author;
    }

    public function setAuthor(?Author $Author): self
    {
        $this->Author = $Author;

        return $this;
    }


}

