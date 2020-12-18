<?php

declare(strict_types=1);


namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;
use App\Entity\Document;

/**
 * @method Document|null find($id, $lockMode = null, $lockVersion = null)
 * @method Document|null findOneBy(array $criteria, array $orderBy = null)
 * @method Document[]    findAll()
 * @method Document[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Document::class);
    }

    /**
     * @param [integer] $id
     *
     * @return void
     * @throws NonUniqueResultException
     */
    public function getDocument($id)
    {
        return $this->createQueryBuilder('d')
                    ->leftJoin('d.user', 'user')
                    ->addSelect('user')
                    ->where('d.author_id = :id')
                    ->setParameter('author_id', $id)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    /**
     * @param $document
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete($document)
    {
        $this->_em->remove($document);
        $this->_em->flush();
    }

// /**
    //  * @return document[] Returns an array of document objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?document
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
