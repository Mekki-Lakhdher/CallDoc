<?php

/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 12/08/2020
 * Time: 17:20
 */
// src/Controller/HomeController.php
namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HomeController extends AbstractController
{

    public function indexAction()
    {
        return $this->render('base.html.twig');
    }

    public function loginAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $this->addFlash('success','Signed in as '.$user.'.');
        return $this->redirectToRoute('home');
    }

}