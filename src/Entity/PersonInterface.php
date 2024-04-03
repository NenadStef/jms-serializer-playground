<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Embedded\AddressInterface;
use App\Entity\Embedded\TelephoneInterface;

interface PersonInterface
{
    public function getId(): string;

    public function getFirstName(): string|null;

    public function setFirstName(string $firstName): void;

    public function getLastName(): string|null;

    public function setLastName(string $lastName): void;

    public function getDateOfBirth(): \DateTimeInterface|null;

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): void;

    public function getAddress(): AddressInterface|null;

    public function setAddress(AddressInterface $address): void;

    /**
     * @return array<int, TelephoneInterface>
     */
    public function getTelephones(): array;

    public function addTelephone(TelephoneInterface $telephone): void;
}