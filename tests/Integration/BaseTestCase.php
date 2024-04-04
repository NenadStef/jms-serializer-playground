<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Tests\Integration;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\GraphNavigatorInterface;
use Jms\Serializer\Playground\Entity\Person;
use Jms\Serializer\Playground\EventListener\GenerateUrlListenerTrait;
use Jms\Serializer\Playground\EventListener\VersionSubscriber;
use Jms\Serializer\Playground\Factory\PersonFactory;
use Jms\Serializer\Playground\Factory\PersonFactoryInterface;
use Jms\Serializer\Playground\Handler\CsvArrayHandler;
use Jms\Serializer\Playground\Handler\PersonCustomSerializerHandlerTrait;
use Jms\Serializer\Playground\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    use GenerateUrlListenerTrait;
    use PersonCustomSerializerHandlerTrait;

    private const APP_CACHE_DIR = __DIR__ . '/../../var/cache';

    private const APP_METADATA_DIR = __DIR__ . '/../../src/Resource/config/serializer';

    private const APP_METADATA_NAMESPACE_PREFIX = 'Jms\Serializer\Playground\Entity';

    protected PersonFactoryInterface|null $personFactory = null;

    protected function setUp(): void
    {
        $this->personFactory = new PersonFactory();
    }

    protected function tearDown(): void
    {
        $this->personFactory = null;
    }

    protected function createSerializer(): Serializer
    {
        $serializerBuilder = new SerializerBuilder(
            self::APP_CACHE_DIR,
            self::APP_METADATA_DIR,
            self::APP_METADATA_NAMESPACE_PREFIX,
            [
                'simple' => [
//                    [
//                        'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
//                        'class' => Person::class,
//                        'type' => 'json',
//                        'callable' => $this->createPersonCustomSerializerHandler(),
//                    ],
                ],
                'subscribing' => [
                    new CsvArrayHandler(),
                ],
            ],
            [
                'listeners' => [
                    [
                        'event' => Events::POST_SERIALIZE,
                        'callable' => $this->createGenerateUrlListener(),
                    ],
                ],
                'subscribers' => [
                    new VersionSubscriber(),
                ],
            ],
            true,
        );

        return $serializerBuilder->build();
    }
}