<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }


    public function searchByTitle($word)
    {

        // utilisation nde la méthode createQueryBuilder parent de la méthode Service entity repositaory
        // tout en définissant un allias pour ma table book
        $queryBuilder= $this->createQueryBuilder('book');


        // je demande a doctrine de faire ma requete sql
        // me permettant de faire un Select sur la table book avec pour paramatre le titre, a condition
        // que celui ci contienne le contenue de $word ( grace a like a un endroit ou un autre du contenu rentré dans la
        // recherche / form
        $query = $queryBuilder->select('book')
            ->where('book.title LIKE :word')
            ->setParameter('word', '%'.$word.'%')
            ->getQuery();

        //on recupere les resultat de la requete sql effectué par doctrine et on la retourne
        // grace a la methode get result de la classe SER
        return $query->getResult();
    }
}