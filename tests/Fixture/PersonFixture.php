<?php

declare(strict_types=1);

namespace Tests\Fixture;

final class PersonFixture
{
    private const PERSON_DATA = [
        'firstName' => 'John',
        'lastName' => 'Doe',
        'dateOfBirth' => '1980-06-05',
        'address' => [
            'street' => 'Oxford Court 4795',
            'city' => 'Memphis',
            'country' => 'US',
            'postCode' => 38133,
        ],
        'telephones' => [
            [
                'type' => 'mobile',
                'number' => 1234567,
            ],
            [
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