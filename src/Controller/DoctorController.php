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

class DoctorController extends AbstractController
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
        $patient = $this->get('security.token_storage')->getToken()->getUser();
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data = $repository->findDoctorsBy($doctor_name,$doctor_speciality);

        $doctors = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('doctor/doctors.html.twig', [
            'patient' => $patient,
            'doctors' => $doctors,
            'doctor_name' => $doctor_name,
            'doctor_speciality' => $doctor_speciality,
        ]);

    }

    public function scheduleAction(int $doctor_id,Request $request)
    {
        $doctor=$this->getDoctrine()
            ->getRepository(User::class)
            ->find($doctor_id);

        $consultation = new Consultation();

        $form = $this->createForm(ConsultationFormType::class, $consultation);

        return $this->render('doctor/doctor_schedule.html.twig', [
            'form' => $form->createView(),
            'doctor' => $doctor,
            'doctor_id' => $doctor_id,
            'choices'  => [
                'id' => $doctor_id,
            ],
        ]);
    }

    public function showDoctorAgendaAction()
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

        $consultations=$repository->findBy(['doctor_id' => $user_id]);

        return $this->render('doctor/show_doctor_agenda.html.twig', [
            'user' => $user,
            'consultations' => $consultations,
        ]);

    }

}