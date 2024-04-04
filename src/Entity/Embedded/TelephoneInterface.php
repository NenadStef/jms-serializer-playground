<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Entity\Embedded;

interface TelephoneInterface
{
    public function getId(): string;

    public function getPhoneNumber(): string;

    public function getType(): string|null;

    public function setType(string $type): void;

    public function getNumber(): int|null;

    public function setNumber(int $number): void;
}