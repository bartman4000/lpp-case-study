<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Entity;


use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Collection implements Validable
{
    /**
     * Name of the collection
     *
     * @Type("string")
     */
    public $collection;

    /**
     * Brand's id
     *
     * @Type("int")
     */
    public $id;

    /**
     * List of brands
     *
     * @Type("array<Lpp\Entity\Brand>")
     */
    public $brands = [];

    /**
     * This method is necessary to convert array of arrays to array of Item objects while deserializing
     * @param Brand $brand
     */
    public function addBrands(Brand $brand)
    {
        $this->brands[] = $brand;
    }

    /**
     * @return mixed
     */
    public function getBrands()
    {
        return $this->brands;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // TODO: Implement loadValidatorMetadata() method.
    }
}