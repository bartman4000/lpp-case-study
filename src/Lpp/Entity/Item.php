<?php
namespace Lpp\Entity;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Represents a single item from a search result.
 *
 */
class Item implements Validable
{
    /**
     * Name of the item
     *
     * @var string
     * @Type("string")
     */
    public $name;

    /**
     * Url of the item's page
     *
     * @var string
     * @Type("string")
     */
    public $url;

    /**
     * Unsorted list of prices received from the
     * actual search query.
     *
     * @var Price[]
     * @Type("array<Lpp\Entity\Price>")
     */
    public $prices = [];

    /**
     * This method is necessary to convert array of arrays to array of Price objects while deserializing
     * @param Price $price
     */
    public function addPrices(Price $price): void
    {
        $this->prices[] = $price;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('url', new Url());
    }
}
