<?php

/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 12/08/2020
 * Time: 17:20
 */
// src/Controller/PatientsController.php
namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\User;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PatientsController extends AbstractController
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

        return $this->render('patients.html.twig', [
            'patients' => $patients,
            'patient_name' => $patient_name,
            'asked_consultations' => $asked_consultations,
        ]);

    }

}