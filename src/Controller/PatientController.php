<?php

/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 12/08/2020
 * Time: 17:20
 */
// src/Controller/PatientController.phpnamespace App\Controller;
namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PatientController extends AbstractController
{

    public function indexAction(Request $request,PaginatorInterface $paginator)
    {
        // Initialize $patient_name
        $patient_name="";
        // If $patient_name is set for the first time
        if (isset($_POST['patient_name']))
        {
            $patient_name=$_POST['patient_name'];
            $_SESSION['patient_name']=$patient_name;
        }
        // If $patient_name is already set
        if (isset($_SESSION['patient_name']))
        {
            $patient_name=$_SESSION['patient_name'];
        }

        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Get all dates
        $repository = $this->getDoctrine()
            ->getRepository(Consultation::class);
        $asked_consultations = $repository->findAll();

        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data=$repository->findPatientsWithTheirConsultations($user_id,$patient_name);
        $patients = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('patient/patients.html.twig', [
            'patients' => $patients,
            'patient_name' => $patient_name,
            'asked_consultations' => $asked_consultations,
        ]);

    }

    public function showPatientAgendaAction()
    {
        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Load user object from database
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user_id);

        // Get user consultations
        $repository = $this->getDoctrine()
            ->getRepository(Consultation::class);

        $consultations=$repository->findBy(['patient_id' => $user_id]);


        return $this->render('patient/show_patient_agenda.html.twig', [
            'user' => $user,
            'consultations' => $consultations,
        ]);

    }

}