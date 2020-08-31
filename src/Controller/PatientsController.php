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
        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data = $repository->findBy(
            ['role' => 'ROLE_PATIENT'],
            ['first_name' => 'ASC']
        );



        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Get all dates
        $repository = $this->getDoctrine()
            ->getRepository(Consultation::class);
        $asked_consultations = $repository->findAll();

        $repository = $this->getDoctrine()
            ->getRepository(User::class);
        $data=$repository->findPatientsWithTheirConsultations($user_id);

        $patients = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('patients.html.twig', [
            'patients' => $patients,
            'asked_consultations' => $asked_consultations,
        ]);

    }

}