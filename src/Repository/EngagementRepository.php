<?php

namespace App\Repository;

use App\Entity\Engagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use PhpParser\Node\Expr\Cast\Array_;

/**
 * @extends ServiceEntityRepository<Prestataire>
 *
 * @method Engagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Engagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Engagement[]    findAll()
 * @method Engagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Engagement::class);
    }

    public function save(Engagement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Engagement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function paginationQuery()
    {
        /*dd($this->createQueryBuilder('p')
        ->orderBy('p.id', 'ASC')
        ->getQuery());*/
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'ASC')
            ->getQuery()
        ;
    }

    public function paginationQueryComplex(array $params) 
    {
        $sql = "SELECT e.* from engagement e where";
        foreach ($params as $key => $value){
            $sql .= " $key LIKE  '%$value%' and";
        }
        // (enlève le dernier and)
        $sql = substr($sql, 0, strlen($sql)-3);
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('App\Entity\Engagement', 'e');
        $query = $this->getEntityManager()->createNativeQuery($sql, $rsm);
        return $query;
    }

//    public function findOneBySomeField($value): ?Prestataire
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}