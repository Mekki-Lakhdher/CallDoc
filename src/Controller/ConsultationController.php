<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 26/08/2020
 * Time: 19:57
 */

namespace App\Controller;


use App\Entity\Consultation;
use App\Form\ConsultationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ConsultationController extends AbstractController
{

    public function askForConsultationAction(Request $request)
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationFormType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
        }
        // Redirect to doctors page after saving
        return $this->redirectToRoute('doctors', [
            'show_message' => 1
        ]);

    }

    public function confirmConsultationAction(int $consultation_id,Request $request) {
        $consultation = $this->getDoctrine()
            ->getRepository(Consultation::class)
            ->find($consultation_id);

        //print_r($consultation->getPatientId());

        $form = $this->createForm(ConsultationFormType::class, $consultation);

        return $this->render('consultation_confirmation.html.twig', [
            'form' => $form->createView(),
            'consultation_id' => $consultation_id,
            'choices'  => [
                'id' => $consultation_id,
                'test' => 10085,
            ],
        ]);
    }

    public function saveConsultationDecisionAction(int $consultation_id,Request $request)
    {

        $consultation = $this->getDoctrine()
            ->getRepository(Consultation::class)
            ->find($consultation_id);
        $form = $this->createForm(ConsultationFormType::class, $consultation);
        $form->handleRequest($request);

//        $confirm_button = $form->get('confirm')->isClicked();
//        $cancel_button = $form->get('cancel')->isClicked();
//        if ($confirm_button) {
//            echo "confirmation clicked";
//        }
//        if ($cancel_button) {
//            echo "cancel clicked";
//        }

        if ($form->isSubmitted() && $form->isValid()) {
            $consultation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
        }
        // Redirect to doctors page after saving
        return $this->redirectToRoute('patients');

    }

}