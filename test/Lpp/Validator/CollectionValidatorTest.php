<?php

use Lpp\Entity\Item;
use Lpp\Validator\CollectionValidator;

/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

class CollectionValidatorTest extends PHPUnit_Framework_TestCase
{
    public function testValidateGoodItem()
    {
        $item = new Item();
        $item->name = 'test item';
        $item->url = "http://www.valid.url";
        $item->prices = [];

        $collectionValidator = new CollectionValidator();
        $result = $collectionValidator::validate($item);

        $this->assertTrue($result);
    }

    /**
     * @expectedException Exception
     */
    public function testValidateBadItem()
    {
        $item = new Item();
        $item->name = 'test item';
        $item->url = "invalidurl";
        $item->prices = [];

        $collectionValidator = new CollectionValidator();
        $collectionValidator::validate($item);
    }
}