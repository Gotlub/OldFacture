<?php

namespace App\Repository;

use App\Entity\Piece;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Piece>
 *
 * @method Piece|null find($id, $lockMode = null, $lockVersion = null)
 * @method Piece|null findOneBy(array $criteria, array $orderBy = null)
 * @method Piece[]    findAll()
 * @method Piece[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PieceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Piece::class);
    }

    public function save(Piece $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Piece $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function paginationQuery()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.identifiantPes', 'ASC')
            ->getQuery()
        ;
    }

    public function paginationQueryComplex(array $params) 
    {
        $sql = "SELECT p.* from piece p where";
        foreach ($params as $key => $value){
            $sql .= " $key LIKE  '%$value%' and";
        }
        $sql = substr($sql, 0, strlen($sql)-3);
        $sql .=" order by p.identifiant_PES";
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\Piece', 'p');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query;
    }

//    /**
//     * @return Piece[] Returns an array of Piece objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Piece
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
