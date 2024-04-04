<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\EventListener;

use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\Metadata\StaticPropertyMetadata;
use Jms\Serializer\Playground\Entity\Person;
use Jms\Serializer\Playground\Entity\PersonInterface;

trait GenerateUrlListenerTrait
{
    private function createGenerateUrlListener(): \Closure
    {
        return function (ObjectEvent $event)
        {
            $entity = $event->getObject();

            if (!$entity instanceof PersonInterface) {
                return;
            }

            $url = sprintf('/resource/person/%s', $entity->getId());

            /** @var JsonSerializationVisitor $visitor */
            $visitor = $event->getVisitor();
            $visitor->visitProperty(new StaticPropertyMetadata('', 'url', $url), $url);
        };
    }
}