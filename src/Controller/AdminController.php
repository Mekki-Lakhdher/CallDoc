<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 03/10/2020
 * Time: 13:47
 */

namespace App\Controller;


use App\Entity\HomePageContent;
use App\Form\HomePageContentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{

    public function showAdminPanelAction() {
        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Load user object from database
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user_id);

        return $this->render('administration_panel.html.twig', [
            'user' => $user,
        ]);
    }

    public function homePageContentAction() {
        // Get logged user_id
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $user_id=$user->getId();

        // Load user object from database
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user_id);

        $home_page_content = new HomePageContent();
        $form = $this->createForm(HomePageContentFormType::class, $home_page_content);

        return $this->render('home_page_content.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    public function addHomePageContentAction(Request $request) {
        $home_page_content = new HomePageContent();
        $form = $this->createForm(HomePageContentFormType::class, $home_page_content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $home_page_content = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($home_page_content);
            $entityManager->flush();
            $this->addFlash('success','Home page content successfully added !');
        }

        // Redirect to doctors page after saving
        return $this->redirectToRoute('administration_panel');
    }

}