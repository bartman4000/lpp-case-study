<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */


namespace Lpp\Entity;


use Symfony\Component\Validator\Mapping\ClassMetadata;

interface Validable
{
    public static function loadValidatorMetadata(ClassMetadata $metadata);
}