<?php

declare(strict_types=1);

namespace App\Entity\Embedded;

interface TelephoneInterface
{
    public function getId(): string;

    public function getType(): string|null;

    public function setType(string $type): void;

    public function getNumber(): int|null;

    public function setNumber(int $number): void;
}