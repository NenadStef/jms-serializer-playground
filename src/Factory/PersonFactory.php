<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Embedded\Address;
use App\Entity\Embedded\AddressInterface;
use App\Entity\Embedded\Telephone;
use App\Entity\Embedded\TelephoneInterface;
use App\Entity\Person;
use App\Entity\PersonInterface;
use Symfony\Component\Uid\Uuid;

final class PersonFactory implements PersonFactoryInterface
{
    /**
     * @param array<string, mixed> $personData
     * @throws \Exception
     */
    public function create(array $personData): PersonInterface
    {
        $person = new Person($this->uuid());

        if (isset($personData['firstName'])) {
            $person->setFirstName($personData['firstName']);
        }

        if (isset($personData['lastName'])) {
            $person->setLastName($personData['lastName']);
        }

        if (isset($personData['dateOfBirth'])) {
            $person->setDateOfBirth(new \DateTime($personData['dateOfBirth']));
        }

        if (isset($personData['address'])) {
            $person->setAddress($this->createAddress($personData['address']));
        }

        if (isset($personData['telephones'])) {
            foreach ($personData['telephones'] as $telephoneData) {
                $person->addTelephone($this->createTelephone($telephoneData));
            }
        }

        return $person;
    }

    /**
     * @param array<string, mixed> $addressData
     */
    private function createAddress(array $addressData): AddressInterface
    {
        $address = new Address($this->uuid());

        if (isset($addressData['street'])) {
            $address->setStreet($addressData['street']);
        }

        if (isset($addressData['city'])) {
            $address->setCity($addressData['city']);
        }

        if (isset($addressData['country'])) {
            $address->setCountry($addressData['country']);
        }

        if (isset($addressData['postCode'])) {
            $address->setPostCode($addressData['postCode']);
        }

        return $address;
    }

    /**
     * @param array<string, mixed> $telephoneData
     */
    private function createTelephone(array $telephoneData): TelephoneInterface
    {
        $telephone = new Telephone($this->uuid());

        if (isset($telephoneData['type'])) {
            $telephone->setType($telephoneData['type']);
        }

        if (isset($telephoneData['number'])) {
            $telephone->setNumber($telephoneData['number']);
        }

        return $telephone;
    }

    private function uuid(): string
    {
        $uuid = Uuid::v4();

        return (string) $uuid;
    }
}