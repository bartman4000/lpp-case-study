<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

use Lpp\Entity\Brand;
use Lpp\Entity\Collection;
use Lpp\Entity\Item;

abstract class AbstractServiceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param $name
     * @param array $items
     * @return Brand
     */
    protected function getBrandMock($name, array $items = [])
    {
        $mockBrand = new Brand();
        $mockBrand->name = $name;
        $mockBrand->description = 'brand test description';
        $mockBrand->items = $items;
        return $mockBrand;
    }

    /**
     * @param $name
     * @param array $prices
     * @return Item
     */
    protected function getItemMock($name, array $prices = [])
    {
        $mockItem = new Item();
        $mockItem->name = $name;
        $mockItem->url = "www.{$name}.item.lpp.com";
        $mockItem->prices = $prices;
        return $mockItem;
    }

    /**
     * @param $name
     * @param $id
     * @param array $brands
     * @return Collection
     */
    protected function getCollectionMock($name, $id, array $brands = [])
    {
        $mockCollection = new Collection();
        $mockCollection->collection = $name;
        $mockCollection->id = $id;
        $mockCollection->brands = $brands;
        return $mockCollection;
    }
}
