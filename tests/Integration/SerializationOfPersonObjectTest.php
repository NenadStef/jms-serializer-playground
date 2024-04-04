<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Tests\Integration;

use Jms\Serializer\Playground\Tests\Fixture\PersonFixture;
use JMS\Serializer\SerializationContext;
use PHPUnit\Framework\Attributes\Group;

#[Group('Integration')]
final class SerializationOfPersonObjectTest extends BaseTestCase
{
    /**
     * @throws \Exception
     */
    public function testPersonIsSerialized(): void
    {
        $personData = PersonFixture::getPersonData();
        $person = $this->personFactory->create($personData);

        $serializer = $this->createSerializer();

        $serializationContext = SerializationContext::create();
        $serializationContext->setGroups([
            'group:serialize:public',
            'group:serialize:private',
        ]);

        $serializedData = $serializer->serialize($person, 'json', $serializationContext);

//        dd($serializedData);
//        dd(json_decode($serializedData, true));

        $expectedData = array_merge(['fullName' => $person->getFullName()], $personData);
        $expectedData['address'] = array_merge(['homeTown' => $person->getAddress()->getHomeTown()], $personData['address']);

        foreach ($expectedData['telephones'] as $key => $telephone) {
            $expectedTelephoneData = ['phoneNumber' => $person->getTelephones()[$key]->getPhoneNumber()];
            $expectedTelephoneData['id'] = $person->getTelephones()[$key]->getId();
            $expectedTelephoneData['type'] = $person->getTelephones()[$key]->getType();
            $expectedTelephoneData['number'] = $person->getTelephones()[$key]->getNumber();

            $expectedData['telephones'][$key] = $expectedTelephoneData;
        }

        $expectedData['personalAttributes'] = implode(',', $person->getPersonalAttributes());
        $expectedData['url'] = '/resource/person/' . $person->getId();

        self::assertEquals(json_encode($expectedData), $serializedData);
    }
}