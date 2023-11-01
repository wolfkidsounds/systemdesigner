<?php // src/Service/NotificationService.php

namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;
use App\Event\ValidationRequestStatusChangeEvent;

class NotificationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onValidationRequestStatusChange(ValidationRequestStatusChangeEvent $event)
    {
        $entity = $event->getEntity();
        $newStatus = $event->getNewStatus();

        if ($entity && ($newStatus === 'validated')) {
            // Create a notification when the status changes
            $notification = new Notification();
            $notification->setName($entity->getName() . ' ' . $newStatus);
            $notification->setMessage('Your request status changed to ' . $newStatus);
            $notification->setStatus('unread');
            $notification->setCreatedAt(new \DateTimeImmutable());
            $notification->addUser($entity->getUser());

            if ($entity->getManufacturer()) {
                $Manufacturer = $entity->getManufacturer()->setValidated(true);
                $this->entityManager->persist($Manufacturer);
            }

            if ($entity->getProcessor()) {
                $Processor = $entity->getProcessor()->setValidated(true);
                $this->entityManager->persist($Processor);
            }

            if ($entity->getAmplifier()) {
                $Amplifier = $entity->getAmplifier()->setValidated(true);
                $this->entityManager->persist($Amplifier);
            }

            if ($entity->getSpeaker()) {
                $Speaker = $entity->getSpeaker()->setValidated(true);
                $this->entityManager->persist($Speaker);
            }

            if ($entity->getChassis()) {
                $Chassis = $entity->getChassis()->setValidated(true);
                $this->entityManager->persist($Chassis);
            }

            $this->entityManager->persist($notification);
            $this->entityManager->flush();
        }

        if ($entity && ($newStatus === 'rejected')) {
            // Create a notification when the status changes
            $notification = new Notification();
            $notification->setName($entity->getName() . ' ' . $newStatus);
            $notification->setMessage('Your request status changed to ' . $newStatus);
            $notification->setStatus('unread');
            $notification->setCreatedAt(new \DateTimeImmutable());
            $notification->addUser($entity->getUser());

            if ($entity->getManufacturer()) {
                $Manufacturer = $entity->getManufacturer()->setValidated(false);
                $this->entityManager->persist($Manufacturer);
            }

            if ($entity->getProcessor()) {
                $Processor = $entity->getProcessor()->setValidated(false);
                $this->entityManager->persist($Processor);
            }

            if ($entity->getAmplifier()) {
                $Amplifier = $entity->getAmplifier()->setValidated(false);
                $this->entityManager->persist($Amplifier);
            }

            if ($entity->getSpeaker()) {
                $Speaker = $entity->getSpeaker()->setValidated(false);
                $this->entityManager->persist($Speaker);
            }

            if ($entity->getChassis()) {
                $Chassis = $entity->getChassis()->setValidated(false);
                $this->entityManager->persist($Chassis);
            }

            $this->entityManager->persist($notification);
            $this->entityManager->flush();
        }
    }
}
