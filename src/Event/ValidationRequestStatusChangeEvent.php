<?php // src/Event/ValidationRequestStatusChangeEvent.php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\ValidationRequest;

class ValidationRequestStatusChangeEvent extends Event
{
    private $entity;
    private $newStatus;

    public function __construct(ValidationRequest $entity, string $newStatus)
    {
        $this->entity = $entity;
        $this->newStatus = $newStatus;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function getNewStatus()
    {
        return $this->newStatus;
    }
}
