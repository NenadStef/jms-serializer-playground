<?php

declare(strict_types=1);

namespace Tests\Integration;

use App\Factory\PersonFactory;
use App\Factory\PersonFactoryInterface;
use PHPUnit\Framework\TestCase;

abstract class BaseTestCase extends TestCase
{
    protected PersonFactoryInterface|null $personFactory = null;

    protected function setUp(): void
    {
        $this->personFactory = new PersonFactory();
    }

    protected function tearDown(): void
    {
        $this->personFactory = null;
    }
}