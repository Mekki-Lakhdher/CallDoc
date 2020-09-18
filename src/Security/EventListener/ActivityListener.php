<?php

namespace App\Security\EventListener;

use Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use App\Entity\User;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Listener that updates the last activity of the authenticated user
 */
class ActivityListener
{
    protected $tokenContext;
    protected $doctrine;

    public function __construct(TokenContext $tokenContext, $doctrine)
    {
        $this->tokenContext= $tokenContext;
        $this->doctrine= $doctrine;
    }

    /**
     * Update the user "lastActivity" on each request
     * @param FilterControllerEvent $event
     */
    public function onCoreController(FilterControllerEvent $event)
    {

        // Check that the current request is a "MASTER_REQUEST"
        // Ignore any sub-request
        if ($event->getRequestType() !== HttpKernel::MASTER_REQUEST) {
            return;
        }

        // Check token authentication availability
        if ($this->tokenContext->getToken()) {
            die();
            $user = $this->tokenContext->getToken()->getUser();

            if ( ($user instanceof User) && !($user->isActiveNow()) ) {
                $user->setLastActivityAt(new \DateTime());
                $this->doctrine->getManager()->flush($user);
            }
        }
    }

    public function onKernelRequest(RequestEvent $event)
    {

        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        // ...
    }
}