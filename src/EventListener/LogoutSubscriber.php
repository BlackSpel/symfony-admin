<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [LogoutEvent::class => 'onLogout'];
    }

    /**
     * @see https://github.com/symfony/symfony/issues/47247 Adding a Flash Message not working in Logout Subscriber when user not auth
     */
    public function onLogout(LogoutEvent $event): void
    {
        $request = $event->getRequest();
        try {
            $flashBag = $request->getSession()->getFlashBag();
        } catch (SessionNotFoundException $e) {
            throw new \LogicException('You cannot use the addFlash method if sessions are disabled. Enable them in "config/packages/framework.yaml".', 0, $e);
        }

        $token = $event->getToken();
        if ($token === null) {
            $flashBag->add('warning', 'User is not authenticated(token)');
            return;
        }

        $user = $token->getUser();
        if ($user === null) {
            $flashBag->add('warning', 'User is not authenticated');
            return;
        }

        $flashBag->add('success', 'Success logout');
    }
}