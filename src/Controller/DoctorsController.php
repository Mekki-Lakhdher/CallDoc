<?php

/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 12/08/2020
 * Time: 17:20
 */
// src/Controller/DoctorsController.php
namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\User;
use App\Form\ConsultationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class DoctorsController extends AbstractController
{

    public function indexAction(Request $request,PaginatorInterface $paginator)
    {
        // Initialize $doctor_name and $doctor_speciality
        $doctor_name=$doctor_speciality="";
        // If $doctor_name and $doctor_speciality are set for the first time
        if (isset($_POST['doctor_name']))
        {
            $doctor_name=$_POST['doctor_name'];
            $_SESSION['doctor_name']=$doctor_name;
        }
        if (isset($_POST['doctor_speciality']))
        {
            $doctor_speciality=$_POST['doctor_speciality'];
            $_SESSION['doctor_speciality']=$doctor_speciality;
        }

        // If $doctor_name and $doctor_speciality are already set
        if (isset($_SESSION['doctor_name']))
        {
            $doctor_name=$_SESSION['doctor_name'];
        }
        if (isset($_SESSION['doctor_speciality']))
        {
            $doctor_speciality=$_SESSION['doctor_speciality'];
        }

        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data = $repository->findDoctorsBy($doctor_name,$doctor_speciality);
        $doctors = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('doctors.html.twig', [
            'doctors' => $doctors,
            'doctor_name' => $doctor_name,
            'doctor_speciality' => $doctor_speciality,
        ]);

        return $this->render('doctors.html.twig');

    }

    public function viewDoctorsList(Request $request,PaginatorInterface $paginator)
    {
//        $doctor_name=$_POST['doctor_name'];
//
//        $speciality_name=$_POST['speciality_name'];
//
//        if ($doctor_name!='undefined')
//        echo "doctor_name=".gettype($doctor_name);
//        if ($speciality_name!='undefined')
//        echo "speciality_name=".$speciality_name;
//        //die();

        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data = $repository->findBy(
            ['role' => 'ROLE_DOCTOR'],
            ['first_name' => 'ASC']
        );
        $doctors = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('doctors_list.html.twig', [
            'doctors' => $doctors
        ]);

    }

    public function scheduleAction(int $doctor_id,Request $request)
    {
        $doctor=$this->getDoctrine()
            ->getRepository(User::class)
            ->find($doctor_id);

        $consultation = new Consultation();

        $form = $this->createForm(ConsultationFormType::class, $consultation);

        return $this->render('doctor_schedule.html.twig', [
            'form' => $form->createView(),
            'doctor' => $doctor,
            'doctor_id' => $doctor_id,
            'choices'  => [
                'id' => $doctor_id,
                'test' => 10085,
            ],
        ]);
    }

}