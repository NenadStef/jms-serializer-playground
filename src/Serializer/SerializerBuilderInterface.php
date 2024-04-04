<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Serializer;

use JMS\Serializer\Serializer;

interface SerializerBuilderInterface
{
    public function build(): Serializer;
}