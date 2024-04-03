<?php

declare(strict_types=1);

namespace Tests\Fixture;

final class PersonFixture
{
    private const PERSON_DATA = [
        'id' => '35b57434-fb17-48c4-a163-90e0611ddbc2',
        'firstName' => 'John',
        'lastName' => 'Doe',
        'dateOfBirth' => '1980-06-05',
        'address' => [
            'id' => '06738231-8d65-47f0-8cfc-0773ec1a1231',
            'street' => 'Oxford Court 4795',
            'city' => 'Memphis',
            'country' => 'US',
            'postCode' => 38133,
        ],
        'telephones' => [
            [
                'id' => '7b8130f9-3e43-4d2f-a293-40e25f8ab3f1',
                'type' => 'mobile',
                'number' => 1234567,
            ],
            [
                'id' => '4241a1cf-b775-43fd-a2d3-ac2bbb007f96',
                'type' => 'home',
                'number' => 9876543,
            ],
        ],
    ];

    /**
     * @return array<string, mixed>
     */
    public static function getPersonData(): array
    {
        return self::PERSON_DATA;
    }
}