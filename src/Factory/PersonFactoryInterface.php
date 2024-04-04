<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Factory;

use Jms\Serializer\Playground\Entity\PersonInterface;

interface PersonFactoryInterface
{
    /**
     * @param array<string, mixed> $personData
     * @throws \Exception
     */
    public function create(array $personData): PersonInterface;
}