<?php

namespace App\Repository;

use App\Entity\Autres;
use App\Entity\Designations;
use App\Entity\Services;
use App\Entity\TypesServices;
use App\Entity\Unites;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Autres>
 *
 * @method Autres|null find($id, $lockMode = null, $lockVersion = null)
 * @method Autres|null findOneBy(array $criteria, array $orderBy = null)
 * @method Autres[]    findAll()
 * @method Autres[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autres::class);
    }

    public function add(Autres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Autres $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Autres[] Returns an array of Autres objects
    */
   public function consultation($date): array
   {
       return $this->createQueryBuilder('a')
           ->andWhere('a.autre_created LIKE :val')
           ->setParameter('val', $value.'%')
           ->orderBy('a.id', 'ASC')
           /* ->setMaxResults(10) */
           ->getQuery()
           ->getResult()
       ;
   }
   /**
    * Fonction permettan de désignations journalière avec conditions
    * @param $_date
    * @param $_sces
    * @param $_maxi
    * @return autres[] Returns an array of Autres objects
    */
    public function consult($_date, $_sces, $_maxi):array
    {
        $dql =  $this   ->createQueryBuilder('a')
                        ->addOrderBy('a.autre_created', 'desc');

        if ('' !== $_date) {
            $dql->andWhere('a.autre_created LIKE :daty')
            ->setParameter('daty', $_date.'%');
        }

        if ('' !== $_sces) {
            $dql->andWhere('a.services = :sces')
            ->setParameter('sces', $_sces);
        }

        if (null !== $_maxi) {
            $dql->setMaxResults($_maxi);
        }

        $autres = $dql->getQuery()->execute();

        return $autres;
    }

//    /**
//     * @return Autres[] Returns an array of Autres objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Autres
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
