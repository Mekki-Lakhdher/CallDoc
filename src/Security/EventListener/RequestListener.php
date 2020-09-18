<?php
/**
 * Created by PhpStorm.
 * User: Mekki
 * Date: 10/09/2020
 * Time: 22:44
 */

namespace App\Security\EventListener;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class RequestListener extends AbstractController
{
    public function __invoke(RequestEvent $event): void
    {
        // Get logged user_id
        $user=$this->getUser();
        if ($user) {
            $user->setLastActivityAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager()->flush($user);
        }

    }
}