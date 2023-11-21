<?php // src/Service/NotificationService.php

namespace App\Service;

use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;

class NotificationService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(string $name, string $message, string $status = 'unread'): Notification
    {
        $notification = new Notification();
        $notification
            ->setName($name)
            ->setMessage($message)
            ->setStatus($status)
            ->setCreatedAt(new \DateTimeImmutable());

        // Assuming you have EntityManager configured, persist the notification.
        $this->entityManager->persist($notification);
        $this->entityManager->flush();

        return $notification;
    }

    public function setStatus(Notification $notification, string $newStatus): void
    {
        $notification->setStatus($newStatus);
        
        // Assuming you have EntityManager configured, update the notification.
        $this->entityManager->persist($notification);
        $this->entityManager->flush();
    }

    public function delete(Notification $notification): void
    {
        // Assuming you have EntityManager configured, remove the notification.
        $this->entityManager->remove($notification);
        $this->entityManager->flush();
    }
}
