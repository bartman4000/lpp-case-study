<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Entity;

use JMS\Serializer\Annotation\Type;

class Collection
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
    public function addBrands(Brand $brand): void
    {
        $this->brands[] = $brand;
    }

    /**
     * @return array<Lpp\Entity\Brand>
     */
    public function getBrands(): array
    {
        return $this->brands;
    }
}
