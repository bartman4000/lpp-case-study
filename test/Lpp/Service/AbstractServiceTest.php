<?php

use Lpp\Entity\Brand;
use Lpp\Entity\Collection;
use Lpp\Entity\Item;

/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */


abstract class AbstractServiceTest extends PHPUnit_Framework_TestCase
{
    protected function getBrandMock($name, array $items = [])
    {
        $mockBrand = new Brand();
        $mockBrand->name = $name;
        $mockBrand->description = 'brand test description';
        $mockBrand->items = $items;
        return $mockBrand;
    }

    protected function getItemMock($name, array $prices = [])
    {
        $mockItem = new Item();
        $mockItem->name = $name;
        $mockItem->url = "www.{$name}.item.lpp.com";
        $mockItem->prices = $prices;
        return $mockItem;
    }

    protected function getCollectionMock($name, $id, array $brands = [])
    {
        $mockCollection = new Collection();
        $mockCollection->collection = $name;
        $mockCollection->id = $id;
        $mockCollection->brands = $brands;
        return $mockCollection;
    }
}
