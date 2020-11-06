<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 26/08/2020
 * Time: 19:57
 */

namespace App\Controller;

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

        return $this->render('user/show_profile.html.twig', [
            'user' => $user,
        ]);

    }

}