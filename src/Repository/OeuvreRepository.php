<?php

namespace App\Repository;

use App\Entity\Oeuvre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oeuvre>
 *
 * @method Oeuvre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Oeuvre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Oeuvre[]    findAll()
 * @method Oeuvre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OeuvreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oeuvre::class);
    }

    public function add(Oeuvre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Oeuvre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Oeuvre[] Returns an array of Oeuvre objects
//     */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('o')
           ->andWhere('o.id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findOeuvreOneUser(int $user, int $oeuvre): array
   {
    $em = $this->getEntityManager();

    $query = $em->createQuery('
        SELECT c
        FROM Oeuvre c
        JOIN c.user i
        WHERE i.id = :id
    ');
    
    $query->setParameter('id', '1');
    
    return $query->getResult();
   }

}
