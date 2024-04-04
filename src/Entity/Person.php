<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Entity;

use Jms\Serializer\Playground\Entity\Embedded\AddressInterface;
use Jms\Serializer\Playground\Entity\Embedded\TelephoneInterface;

class Person implements PersonInterface
{
    private string $id;

    private string|null $firstName = null;

    private string|null $lastName = null;

    private \DateTimeInterface|null $dateOfBirth = null;

    private AddressInterface|null $address = null;

    /**
     * @var array<int, TelephoneInterface>
     */
    private array $telephones = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFullName(): string|null
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getFirstName(): string|null
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string|null
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getDateOfBirth(): \DateTimeInterface|null
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): void
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getAddress(): AddressInterface|null
    {
        return $this->address;
    }

    public function setAddress(AddressInterface $address): void
    {
        $this->address = $address;
    }

    /**
     * @return array<int, TelephoneInterface>
     */
    public function getTelephones(): array
    {
        return $this->telephones;
    }

    public function addTelephone(TelephoneInterface $telephone): void
    {
        $this->telephones[] = $telephone;
    }
}