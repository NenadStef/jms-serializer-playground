<?php

declare(strict_types=1);

namespace Jms\Serializer\Playground\Serializer;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\Handler\HandlerRegistry ;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder as BaseSerializerBuilder;

final readonly class SerializerBuilder implements SerializerBuilderInterface
{
    public function __construct(
        private string $cacheDir,
        private string $metadataDir,
        private string $namespacePrefix = '',
        private array  $handlers = [],
        private array  $eventListeners = [],
        private bool   $debug = false,
    ) {
    }

    public function build(): Serializer
    {
        $jmsBuilder = BaseSerializerBuilder::create();

        $this->setCacheAndMetadataDirs($jmsBuilder);
        $this->setDefaultSerializationContexts($jmsBuilder);
        $this->setDefaultDeserializationContexts($jmsBuilder);
        $this->setHandlers($jmsBuilder);
        $this->setEventListeners($jmsBuilder);

        return $jmsBuilder->build();
    }

    private function setCacheAndMetadataDirs(BaseSerializerBuilder $jmsBuilder): void
    {
        $jmsBuilder->addMetadataDir($this->metadataDir, $this->namespacePrefix);
        $jmsBuilder->setCacheDir($this->cacheDir);
        $jmsBuilder->setDebug($this->debug);
    }

    private function setDefaultSerializationContexts(BaseSerializerBuilder $jmsBuilder): void
    {
        $jmsBuilder->setSerializationContextFactory(function() {
            return SerializationContext::create()
                ->setSerializeNull(true);
        });
    }

    private function setDefaultDeserializationContexts(BaseSerializerBuilder $jmsBuilder): void
    {
        $jmsBuilder->setDeserializationContextFactory(function() {
            return DeserializationContext::create();
        });
    }

    private function setHandlers(BaseSerializerBuilder $jmsBuilder): void
    {
        if (empty($this->handlers)) {
            return;
        }

        $handlers = $this->handlers;

        $jmsBuilder->addDefaultHandlers();
        $jmsBuilder->configureHandlers(function (HandlerRegistry $registry) use ($handlers) {
            if (isset($handlers['simple'])) {
                foreach ($handlers['simple'] as $simpleHandler) {
                    $registry->registerHandler(
                        $simpleHandler['direction'],
                        $simpleHandler['class'],
                        $simpleHandler['type'],
                        $simpleHandler['callable'],
                    );
                }
            }

            if (isset($handlers['subscribing'])) {
                foreach ($handlers['subscribing'] as $subscribingHandler) {
                    $registry->registerSubscribingHandler($subscribingHandler);
                }
            }
        });
    }

    private function setEventListeners(BaseSerializerBuilder $jmsBuilder): void
    {
        if (empty($this->eventListeners)) {
            return;
        }

        $eventListeners = $this->eventListeners;

        $jmsBuilder->configureListeners(function (EventDispatcher $dispatcher) use ($eventListeners) {
            if (isset($eventListeners['listeners'])) {
                foreach ($eventListeners['listeners'] as $listener) {
                    $dispatcher->addListener($listener['event'], $listener['callable']);
                }
            }

            if (isset($eventListeners['subscribers'])) {
                foreach ($eventListeners['subscribers'] as $subscriber) {
                    $dispatcher->addSubscriber($subscriber);
                }
            }
        });
    }
}