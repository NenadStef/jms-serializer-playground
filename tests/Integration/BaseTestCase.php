<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Tests\Integration;

use Jms\Serializer\Playground\Factory\PersonFactory;
use Jms\Serializer\Playground\Factory\PersonFactoryInterface;
use Jms\Serializer\Playground\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
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

    protected function createSerializer(
        array $handlers = [],
        array $eventListeners = [],
        bool  $debug = true,
    ): Serializer {
        $serializerBuilder = new SerializerBuilder(
            self::APP_CACHE_DIR,
            self::APP_METADATA_DIR,
            self::APP_METADATA_NAMESPACE_PREFIX,
            $handlers,
            $eventListeners,
            $debug,
        );

        return $serializerBuilder->build();
    }
}