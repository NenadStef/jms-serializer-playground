<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\EventListener;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use Jms\Serializer\Playground\Entity\Person;
use Jms\Serializer\Playground\Entity\PersonInterface;
use Jms\Serializer\Playground\Entity\VersionInterface;

final class VersionSubscriber implements VersionSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            [
                'event' => Events::POST_DESERIALIZE,
                'method' => 'onPostDeserialize',
                'class' => Person::class,
            ],
        ];
    }

    public function onPostDeserialize(ObjectEvent $event): void
    {
        $event->getObject()->setVersion();
    }
}