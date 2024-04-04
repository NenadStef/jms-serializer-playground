<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Tests\Integration;

use JMS\Serializer\DeserializationContext;
use Jms\Serializer\Playground\Entity\Person;
use Jms\Serializer\Playground\Tests\Fixture\PersonFixture;
use PHPUnit\Framework\Attributes\Group;

#[Group('Integration')]
final class DeserializationOfPersonObjectTest extends BaseTestCase
{
    public function testPersonIsDeserialized(): void
    {
        $personData = PersonFixture::getPersonData();

        $serializer = $this->createSerializer();

        $deserializationContext = DeserializationContext::create();
        $deserializationContext->setGroups([
            'group:deserialize:private'
        ]);

        $deserializedData = $serializer->deserialize(
            json_encode($personData),
            Person::class,
            'json',
            $deserializationContext
        );

//        var_dump($deserializedData); die;

        self::assertEquals($personData['id'], $deserializedData->getId());
        self::assertEquals($personData['firstName'], $deserializedData->getFirstName());
        self::assertEquals($personData['lastName'], $deserializedData->getLastName());
        self::assertEquals($personData['dateOfBirth'], $deserializedData->getDateOfBirth()->format('c'));

        self::assertEquals($personData['address']['id'], $deserializedData->getAddress()->getId());
        self::assertEquals($personData['address']['street'], $deserializedData->getAddress()->getStreet());
        self::assertEquals($personData['address']['city'], $deserializedData->getAddress()->getCity());
        self::assertEquals($personData['address']['country'], $deserializedData->getAddress()->getCountry());
        self::assertEquals($personData['address']['postCode'], $deserializedData->getAddress()->getPostCode());

        foreach ($deserializedData->getTelephones() as $key => $telephone) {
            self::assertEquals($personData['telephones'][$key]['id'], $telephone->getId());
            self::assertEquals($personData['telephones'][$key]['type'], $telephone->getType());
            self::assertEquals($personData['telephones'][$key]['number'], $telephone->getNumber());
        }
    }
}