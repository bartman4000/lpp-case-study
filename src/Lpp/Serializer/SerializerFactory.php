<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Serializer;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Serializer;
use Lpp\Entity\Item;
use Lpp\Validator\EntityValidator;

class SerializerFactory
{

    /**
     * Factory returning Serializer
     * @return Serializer
     */
    public static function build(): Serializer
    {
        $builder = SerializerBuilder::create();
        $builder->configureListeners(function (EventDispatcher $dispatcher) {
            $dispatcher->addListener(
                Events::POST_DESERIALIZE,
                function (ObjectEvent $event) {
                    call_user_func([EntityValidator::class, 'validate'], $event->getObject());
                }, Item::class
            );
        });

        return $builder->build();
    }
}
