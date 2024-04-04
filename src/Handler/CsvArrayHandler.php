<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\JsonSerializationVisitor;

final class CsvArrayHandler implements CsvArrayHandlerInterface
{
    public static function getSubscribingMethods(): array
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'csv_array',
                'method' => 'serializeToCsvArray',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'csv_array',
                'method' => 'deserializeFromCsvArray',
            ],
        ];
    }

    public function serializeToCsvArray(
        JsonSerializationVisitor $visitor,
        array $array,
        array $type,
        Context $context
    ): string {
        return implode(',', $array);
    }

    public function deserializeFromCsvArray(
        JsonDeserializationVisitor $visitor,
        string $csvString,
        array $type,
        Context $context
    ): array {
        return explode(',', $csvString);
    }
}