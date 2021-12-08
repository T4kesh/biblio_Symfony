<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
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

    /**
     * grace a la propiété de ManyToOne je join mon entité book a l'entité auteur
     * cette fonction me permet de faire executer a symfony la raequete sql normalement nécéssaire a executer
     * ainsi que de relier ma table book a la colonne author grace aux clés étrangere
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     */
    private $author;

    /**
     * je join l'entité book a l'entité genre grace a la propriété ManyToOne
     * via leurs clé étrangère ManyToOne va donc remplacer la requete sql que je devrais normalement effectuer
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="genre")
     */
    private $books;

    /**
     * @ORM\ManyToOne(targetEntity=book::class)
     */
    private $genre;


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


    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setGenre($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getGenre() === $this) {
                $book->setGenre(null);
            }
        }

        return $this;
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


}

