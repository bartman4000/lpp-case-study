<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Serializer;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Lpp\Validator\CollectionValidator;

class SerializerFactory
{

    /**
     * @return Serializer
     */
    public static function build()
    {
        $builder = SerializerBuilder::create();
        $builder->configureListeners(function(EventDispatcher $dispatcher) {
            $dispatcher->addListener('serializer.post_deserialize',
                function(ObjectEvent $event) {
                    call_user_func([CollectionValidator::class, 'validate'], $event->getObject());
                }
            );
        });

        return $builder->build();
    }
}