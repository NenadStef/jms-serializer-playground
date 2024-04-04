<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Handler;

use Jms\Serializer\Playground\Entity\PersonInterface;

trait PersonCustomSerializerHandlerTrait
{
    private function createPersonCustomSerializerHandler(): \Closure
    {
        return function ($visitor, PersonInterface $person, array $type)
        {
            $formatted = [];

            foreach ($person->getTelephones() as $telephone) {
                $formatted[] = $telephone->getPhoneNumber();
            }

            return [
                $person->getFullName(),
                $person->getDateOfBirth()->format('Y-m-d'),
                $person->getAddress()->getHomeTown(),
                $person->getPersonalAttributes(),
                $formatted,
            ];
        };
    }
}