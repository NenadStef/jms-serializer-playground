<?php

declare(strict_types=1);

namespace App\Entity\Embedded;

final class Telephone implements TelephoneInterface
{
    private string $id;

    private string|null $type = null;

    private int|null $number = null;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNumber(): int|null
    {
        return $this->number;
    }

    public function setNumber(int $number): void
    {
        $this->number = $number;
    }
}