<?php //src/EventSubscriber/LocaleSubscriber.php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    public function onKernelRequest(RequestEvent $event): void
    {        
        $request = $event->getRequest();
        $locale = $event->getRequest()->getSession()->get('_locale');

        if ($locale) {
            $request->setLocale($locale);
            $event->getRequest()->getSession()->set('_locale', $locale);
        }
    }

    public function onInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();

        if ($user instanceof User) {
            $locale = $user->getLocale();

            if ($locale) {
                $event->getRequest()->getSession()->set('_locale', $locale);
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 17],
            InteractiveLoginEvent::class => ['onInteractiveLogin', 10],
        ];
    }
}
