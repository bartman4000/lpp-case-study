<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Serializer;

use JMS\Serializer\EventDispatcher\EventDispatcher;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Lpp\Entity\Validable;
use Lpp\Validator\EntityValidator;

class SerializerFactory
{

    /**
     * Factory returning SerializeInterface
     * @return Serializer
     */
    public static function build()
    {
        $builder = SerializerBuilder::create();
        $builder->configureListeners(function (EventDispatcher $dispatcher) {
            $dispatcher->addListener(
                'serializer.post_deserialize',
                function (ObjectEvent $event) {
                    if ($event instanceof Validable) {
                        call_user_func([EntityValidator::class, 'validate'], $event->getObject());
                    }
                }
            );
        });

        return $builder->build();
    }
}
