<?php

namespace App\Repository;

use App\Entity\Consultation;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findPatientsWithTheirConsultations($doctor_id,$patient_name): array
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT `first_name`,
                `last_name`,
                `phone_number`,
                `email`,
                `consultation`.`id` as `consultation_id`,
                `consultation`.`confirmed`,
                `consultation`.`canceled`
                FROM `user`               
                LEFT JOIN `consultation`             
                ON `user`.`id`=`consultation`.`patient_id_id` AND `consultation`.`doctor_id_id`=:doctor_id               
                WHERE `user`.`role`='ROLE_PATIENT'";

        // Add condition on patient name if it's set
        if ($patient_name!="") {
            $sql=$sql." AND `user`.`first_name` LIKE'%$patient_name%' OR `user`.`last_name` LIKE'%$patient_name%'";
        }



        $stmt = $conn->prepare($sql);
        $stmt->execute(['doctor_id' => $doctor_id]);
        $result = $stmt->fetchAll();

        // returns an array of arrays (i.e. a raw data set)
        return $result;

    }

    public function findDoctorsBy($doctor_name,$doctor_speciality): array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.role = :role')
            ->andWhere('u.first_name LIKE :doctor_name or u.last_name LIKE :doctor_name')
            ->andWhere('u.speciality LIKE :doctor_speciality')
            ->setParameter('role', 'ROLE_DOCTOR')
            ->setParameter('doctor_name', '%'.$doctor_name.'%')
            ->setParameter('doctor_speciality', '%'.$doctor_speciality.'%')
            ->orderBy('u.first_name', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

}