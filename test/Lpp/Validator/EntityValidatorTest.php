<?php

use Lpp\Entity\Item;
use Lpp\Validator\EntityValidator;
use PHPUnit\Framework\TestCase;

/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

class EntityValidatorTest extends TestCase
{
    public function testValidateGoodItem()
    {
        $item = new Item();
        $item->name = 'test item';
        $item->url = "http://www.valid.url";
        $item->prices = [];

        $collectionValidator = new EntityValidator();
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

        $collectionValidator = new EntityValidator();
        $collectionValidator::validate($item);
    }
}
