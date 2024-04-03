<?php

declare(strict_types=1);

namespace App\Entity\Embedded;

interface AddressInterface
{
    public function getId(): string;

    public function getStreet(): string|null;

    public function setStreet(string $street): void;

    public function getCity(): string|null;

    public function setCity(string $city): void;

    public function getCountry(): string|null;

    public function setCountry(string $country): void;

    public function getPostCode(): int|null;

    public function setPostCode(int $postCode): void;
}