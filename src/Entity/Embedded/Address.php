<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Entity\Embedded;

class Address implements AddressInterface
{
    private string $id;

    private string|null $street = null;

    private string|null $city = null;

    private string|null $country = null;

    private int|null $postCode = null;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getHomeTown(): string
    {
        return $this->city . ' ' . $this->country;
    }

    public function getStreet(): string|null
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string|null
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): string|null
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getPostCode(): int|null
    {
        return $this->postCode;
    }

    public function setPostCode(int $postCode): void
    {
        $this->postCode = $postCode;
    }
}