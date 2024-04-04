<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Entity;

use Jms\Serializer\Playground\Entity\Embedded\AddressInterface;
use Jms\Serializer\Playground\Entity\Embedded\TelephoneInterface;
use Symfony\Component\Uid\Uuid;

class Person implements PersonInterface
{
    private string $id;

    private string|null $version = null;

    private string|null $firstName = null;

    private string|null $lastName = null;

    private \DateTimeInterface|null $dateOfBirth = null;

    private AddressInterface|null $address = null;

    /**
     * @var array<int, TelephoneInterface>
     */
    private array $telephones = [];

    /**
     * @var array<int, string>
     */
    private array $personalAttributes = [];

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getVersion(): string|null
    {
        return $this->version;
    }

    public function setVersion(): void
    {
        $this->version = (string) Uuid::v4();
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

    /**
     * @return array<int, string>
     */
    public function getPersonalAttributes(): array
    {
        return $this->personalAttributes;
    }

    public function addPersonalAttribute(string $personalAttribute): void
    {
        $this->personalAttributes[] = $personalAttribute;
    }
}