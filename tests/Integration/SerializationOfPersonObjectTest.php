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

//        var_dump(json_decode($serializedData, true)); die;

        $expectedData = array_merge(['fullName' => $person->getFullName()], $personData);
        $expectedData['address'] = array_merge(['homeTown' => $person->getAddress()->getHomeTown()], $personData['address']);

        foreach ($expectedData['telephones'] as $key => $telephone) {
            $modifiedTelephone = ['phoneNumber' => $person->getTelephones()[$key]->getPhoneNumber()];
            $modifiedTelephone['id'] = $person->getTelephones()[$key]->getId();
            $modifiedTelephone['type'] = $person->getTelephones()[$key]->getType();
            $modifiedTelephone['number'] = $person->getTelephones()[$key]->getNumber();

            $expectedData['telephones'][$key] = $modifiedTelephone;
        }

        self::assertEquals(json_encode($expectedData), $serializedData);
    }
}