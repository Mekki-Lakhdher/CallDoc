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
use Knp\Component\Pager\PaginatorInterface;
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
        $this->addFlash('success','Consultation asked from Dr. '.$consultation->getDoctorId().'.');
        // Redirect to doctors page after saving
        return $this->redirectToRoute('doctors');

    }

    public function confirmConsultationAction(int $consultation_id,Request $request) {

        $consultation = $this->getDoctrine()
            ->getRepository(Consultation::class)
            ->find($consultation_id);

        $form = $this->createForm(ConsultationFormType::class, $consultation);

        return $this->render('consultation/consultation_confirmation.html.twig', [
            'consultation' => $consultation,
            'form' => $form->createView(),
            'consultation_id' => $consultation_id,
            'choices'  => [
                'id' => $consultation_id,
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

        if ($form->isSubmitted() && $form->isValid()) {
            $consultation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
        }
        // Redirect to patients page after saving
        return $this->redirectToRoute('patients');
    }

    public function getDoctorConsultationsAction(Request $request)
    {
        return $this->render('consultation/.html.twig', [
            'consultation_id' => 1,
        ]);
    }

    public function getPatientConsultationsAction(Request $request,PaginatorInterface $paginator)
    {
        // Initialize $patient_name
        $doctor_name="";
        // If $patient_name is set for the first time
        if (isset($_POST['doctor_name']))
        {
           $doctor_name=$_POST['doctor_name'];
            $_SESSION['doctor_name']=$doctor_name;
        }
        // If $patient_name is already set
        if (isset($_SESSION['doctor_name']))
        {
            $doctor_name=$_SESSION['doctor_name'];
        }

        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $connected_patient=$user->getId();

        // Get all consultations
        $repository = $this->getDoctrine()
            ->getRepository(Consultation::class);
        $data = $repository->findConsultationsBy($connected_patient,$doctor_name);

        $patient_consultations = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('consultation/patient_consultations.html.twig', [
            'patient_consultations' => $patient_consultations,
            'doctor_name' => $doctor_name,
        ]);
    }

    public function viewPatientConsultationAction(int $consultation_id,Request $request)
    {
        $consultation = $this->getDoctrine()
            ->getRepository(Consultation::class)
            ->find($consultation_id);

        $form = $this->createForm(ConsultationFormType::class, $consultation);

        return $this->render('consultation/view_patient_consultation.html.twig', [
            'consultation' => $consultation,
            'form' => $form->createView(),
            'consultation_id' => $consultation_id,
            'choices'  => [
                'id' => $consultation_id,
            ],
        ]);
    }

    public function editPatientConsultationAction(int $consultation_id,Request $request) {
        $consultation = $this->getDoctrine()
            ->getRepository(Consultation::class)
            ->find($consultation_id);
        $form = $this->createForm(ConsultationFormType::class, $consultation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $consultation = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
        }
        // Add flash message
        $this->addFlash('success', 'Consultation edited.');
        // Redirect to patients page after saving
        return $this->redirectToRoute('patient_consultations');

    }

}