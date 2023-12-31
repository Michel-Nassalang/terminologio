<?php

namespace App\Repository;

use App\Entity\Traduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Traduction>
 *
 * @method Traduction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traduction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traduction[]    findAll()
 * @method Traduction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Traduction::class);
    }

//    /**
//     * @return Traduction[] Returns an array of Traduction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

   /**
    * @return Traduction[] Returns an array of Traduction objects
    */
   public function findByLang($lang, $illus): array
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.lang = :val')
           ->setParameter('val', $lang)
           ->andWhere('t.illustration = :var')
           ->setParameter('var', $illus)
           ->orderBy('t.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Traduction
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
