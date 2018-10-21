<?php
namespace Lpp\Entity;

use JMS\Serializer\Annotation\Type;

/**
 * Represents a single brand in the result.
 *
 */
class Brand
{
    /**
     * Name of the brand
     *
     * @var string
     * @Type("string")
     */
    public $name;

    /**
     * Brand's description
     *
     * @var string
     * @Type("string")
     */
    public $description;

    /**
     * Unsorted list of items with their corresponding prices.
     *
     * @var Item[]
     * @Type("array<Lpp\Entity\Item>")
     */
    public $items = [];

    /**
     * This method is necessary to convert array of arrays to array of Item objects while deserializing
     * @param Item $item
     */
    public function addItems(Item $item): void
    {
        $this->items[] = $item;
    }
}
