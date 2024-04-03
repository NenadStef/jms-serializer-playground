<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\PersonInterface;

interface PersonFactoryInterface
{
    /**
     * @param array<string, mixed> $personData
     * @throws \Exception
     */
    public function create(array $personData): PersonInterface;
}