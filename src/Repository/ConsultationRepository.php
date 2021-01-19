<?php

namespace App\Repository;

use App\Entity\Consultation;
use DateInterval;
use DateTime;
use DateTimeZone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Consultation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Consultation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Consultation[]    findAll()
 * @method Consultation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsultationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Consultation::class);
    }

    // /**
    //  * @return Consultation[] Returns an array of Consultation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Consultation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findUserConsultations($user_id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "
        SELECT * FROM `consultation` WHERE `doctor_id`=:user_id OR `patient_id_id`=:user_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['user_id' => $user_id]);
        $result = $stmt->fetchAll();

        // returns an array of arrays (i.e. a raw data set)
        return $result;

    }

    public function findPatientConsultationsBy($connected_patient,$doctor_name): array
    {
        $conn=$this->getEntityManager()->getConnection();
        $sql="
            SELECT
	            `consultation`.`id` as consultation_id,
                `consultation`.`date` as consultation_date,
                `consultation`.`asked_by_patient` as consultation_asked_by_patient,
                `consultation`.`confirmed_by_doctor` as consultation_confirmed_by_doctor,
                `consultation`.`canceled_by_doctor` as consultation_canceled_by_doctor,
                CONCAT( `user`.`first_name`,' ', `user`.`last_name` ) as consultation_doctor,
                `consultation`.`description` as consultation_description
            FROM 
                `consultation` 
            LEFT JOIN 
                `user` 
            ON 
                `consultation`.`doctor_id_id`=`user`.`id` 
            WHERE 
                `user`.`first_name` LIKE '%$doctor_name%'
            AND 
                `consultation`.`patient_id_id`=$connected_patient;";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (isset($result[0])) {
            $utc_consultation_time = new DateTime($result[0]['consultation_date']);
            $user_time = new DateTimeZone('Africa/Tunis');
            $utc_consultation_time->setTimezone($user_time);

            $result[0]['consultation_date'] = $utc_consultation_time->format('Y-m-d H:i:s');
        }
        // returns an array of arrays (i.e. a raw data set)
        return $result;
    }

    public function findDoctorConsultationsBy($connected_doctor,$patient_name): array
    {
        $conn=$this->getEntityManager()->getConnection();
        $sql="
            SELECT
	            `consultation`.`id` as consultation_id,
                `consultation`.`date` as consultation_date,
                `consultation`.`asked_by_patient` as consultation_asked_by_patient,
                `consultation`.`confirmed_by_doctor` as consultation_confirmed_by_doctor,
                `consultation`.`canceled_by_doctor` as consultation_canceled_by_doctor,
                CONCAT( `user`.`first_name`,' ', `user`.`last_name` ) as consultation_doctor,
                `consultation`.`description` as consultation_description
            FROM 
                `consultation` 
            LEFT JOIN 
                `user` 
            ON 
                `consultation`.`doctor_id_id`=`user`.`id` 
            WHERE 
                `user`.`first_name` LIKE '%$patient_name%'
            AND 
                `consultation`.`doctor_id_id`=$connected_doctor;";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        if (isset($result[0])) {
            $utc_consultation_time = new DateTime($result[0]['consultation_date']);
            $user_time = new DateTimeZone('Africa/Tunis');
            $utc_consultation_time->setTimezone($user_time);
            $result[0]['consultation_date'] = $utc_consultation_time->format('Y-m-d H:i:s');
        }
        // returns an array of arrays (i.e. a raw data set)
        return $result;
    }

}
