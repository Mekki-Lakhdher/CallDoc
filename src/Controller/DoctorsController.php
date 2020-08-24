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

        $consultation = new Consultation();
        $form = $this->createForm(ConsultationFormType::class, $consultation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $consultation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
        }

        return $this->render('doctors.html.twig', [
            'doctors' => $doctors
        ]);
    }

    public function scheduleAction(int $doctor_id,Request $request)
    {
        $doctor = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($doctor_id);

        $consultation = new Consultation();

        $form = $this->createForm(ConsultationFormType::class, $consultation);



        return $this->render('doctor_schedule.html.twig', [
            'form' => $form->createView(),
            'doctor_id' => $doctor_id,
            'choices'  => [
                'id' => $doctor_id,
                'test' => 10085,
            ],
        ]);
    }

}