<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */


namespace Lpp\Entity;

use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Delivers one method where you define constraints for object validation
 * in $metadata->addPropertyConstraint() manner
 */
interface Validable
{
    public static function loadValidatorMetadata(ClassMetadata $metadata);
}
