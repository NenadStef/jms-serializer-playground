<?php

declare(strict_types=1);

namespace Tests\Integration;

use PHPUnit\Framework\Attributes\Group;
use Tests\Fixture\PersonFixture;

#[Group('Integration')]
final class CreatePersonTest extends BaseTestCase
{
    /**
     * @throws \Exception
     */
    public function testPersonIsCreated(): void
    {
        $personData = PersonFixture::getPersonData();

        $person = $this->personFactory->create($personData);

        self::assertNotNull($person->getId());
        self::assertEquals($personData['firstName'], $person->getFirstName());
        self::assertEquals($personData['lastName'], $person->getLastName());
        self::assertEquals($personData['dateOfBirth'], $person->getDateOfBirth()->format('Y-m-d'));

        self::assertNotNull($person->getAddress()->getId());
        self::assertEquals($personData['address']['street'], $person->getAddress()->getStreet());
        self::assertEquals($personData['address']['city'], $person->getAddress()->getCity());
        self::assertEquals($personData['address']['country'], $person->getAddress()->getCountry());
        self::assertEquals($personData['address']['postCode'], $person->getAddress()->getPostCode());

        foreach ($person->getTelephones() as $key => $telephone) {
            self::assertNotNull($telephone->getId());
            self::assertEquals($personData['telephones'][$key]['type'], $telephone->getType());
            self::assertEquals($personData['telephones'][$key]['number'], $telephone->getNumber());
        }
    }
}