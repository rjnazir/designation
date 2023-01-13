<?php

namespace App\Repository;

use App\Entity\Designations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DateTime;
/**
 * @extends ServiceEntityRepository<Designations>
 *
 * @method Designations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Designations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Designations[]    findAll()
 * @method Designations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DesignationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Designations::class);
    }

    public function add(Designations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Designations $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findJour()
    {
        $aujourdhui = new \DateTime('now'); //Date du  \DateTime('now')jour
        $formattedDate = $aujourdhui->format('d/m/Y');
        $qb=$this->createQueryBuilder('p');
        $qb -> where('p.desgn_created = :aujourdhui')
            -> setParameter('aujourdhui',$aujourdhui);
        return $qb -> getQuery()
                   -> getResult();
    }

//    /**
//     * @return Designations[] Returns an array of Designations objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()val
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Designations
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
