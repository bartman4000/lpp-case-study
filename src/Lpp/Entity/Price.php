<?php

namespace Lpp\Entity;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * Represents a single price from a search result
 * related to a single item.
 * 
 */
class Price implements Validable
{
    /**
     * Description text for the price
     * 
     * @var string
     * @Type("string")
     */
    public $description;

    /**
     * Price in euro
     *
     * @var int
     * @Type("int")
     * @SerializedName("priceInEuro")
     */
    public $priceInEuro;

    /**
     * Warehouse's arrival date (to)
     *
     * @var \DateTime
     * @Type("DateTime<'Y-m-d'>")
     * @SerializedName("arrival")
     */
    public $arrivalDate;

    /**
     * Due to date,
     * defining how long will the item be available for sale (i.e. in a collection)
     *
     * @var \DateTime
     * @Type("DateTime<'Y-m-d'>")
     * @SerializedName("due")
     */
    public $dueDate;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        // TODO: Implement loadValidatorMetadata() method.
    }
}
