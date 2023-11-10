<?php // src/EventSubscriber/AdminValidationRequestSubscriber.php
namespace App\EventSubscriber;

use App\Entity\Notification;
use App\Entity\ValidationRequest;
use App\Service\NotificationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class AdminValidationRequestSubscriber implements EventSubscriberInterface
{
    public function __construct()
    {

    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['checkNotification'],
        ];
    }

    public function checkNotification(BeforeEntityUpdatedEvent $event, NotificationService $notificationService)
    {
        /** @var ValidationRequest $entity */
        $entity = $event->getEntityInstance();

        if ($entity->getStatus() == 'validated' || $entity->getStatus() == 'rejected') {

            $notification = $this->createNotification($entity, $notificationService);
            return $notification;       
        }
    }

    public function createNotification($entity, NotificationService $notificationService) : Notification
    {
        $notificationMessage = 'The status of ' . $entity->getName() . ' has been changed to ' . $entity->getStatus();
        $notification = $notificationService->create('Status Change of ' . $entity->getName(), $notificationMessage);

        return $notification;
    }
}