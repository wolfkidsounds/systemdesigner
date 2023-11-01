<?php // src/EventSubscriber/ValidationRequestSubscriber.php

namespace App\EventSubscriber;

use Doctrine\ORM\Events;
use App\Entity\ValidationRequest;
use App\Service\NotificationService;
use Doctrine\Common\EventSubscriber;
use App\Event\ValidationRequestStatusChangeEvent;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ValidationRequestSubscriber implements EventSubscriber
{
    private $notificationService;
    private $eventDispatcher;

    public function __construct(NotificationService $notificationService, EventDispatcherInterface $eventDispatcher)
    {
        $this->notificationService = $notificationService;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();

        dump($entity);

        // Check if the entity is a ValidationRequest and the status property has changed
        if ($entity instanceof ValidationRequest && $args->hasChangedField('Status')) {
            $newStatus = $args->getNewValue('Status');

            if ($newStatus === 'validated' || $newStatus === 'rejected') {
                // Dispatch a custom event to handle the notification creation
                $this->eventDispatcher->dispatch(new ValidationRequestStatusChangeEvent($entity, $newStatus), 'validation_request.status_changed');
            }
        }
    }
}
