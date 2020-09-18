<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 26/08/2020
 * Time: 19:57
 */

namespace App\Controller;

use App\Entity\Consultation;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    public function showProfileAction()
    {
        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Load user object from database
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user_id);

        return $this->render('show_profile.html.twig', [
            'user' => $user,
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

        return $this->render('show_doctor_agenda.html.twig', [
            'user' => $user,
            'consultations' => $consultations,
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

        return $this->render('show_patient_agenda.html.twig', [
            'user' => $user,
            'consultations' => $consultations,
        ]);

    }

}