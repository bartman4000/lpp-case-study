<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */


namespace Lpp\Validator;

use Lpp\Entity\Validable;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validation;

class CollectionValidator
{

    /**
     * ItemValidator constructor.
     */
    public static function validate(Validable $item)
    {
        $validator = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator();

        $errors = $validator->validate($item);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new ValidatorException($errorsString);
        }

        return true;
    }
}