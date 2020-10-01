<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 28/09/2020
 * Time: 16:11
 */

namespace App\Controller;

use App\Repository\DoctorSpecialistTitleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DoctorSpecialityTitleController extends AbstractController
{

    /**
     * @Route("/doctors/specialities", methods="POST", name="doctor_speciality")
     */
    public function getUsersApi(DoctorSpecialistTitleRepository $doctorSpecialistTitleRepository)
    {
        $specialities = $doctorSpecialistTitleRepository->findSpec();
        return $this->json([
            'specialities' => $specialities
        ], 200, [], ['groups' => ['main']]);
    }

}