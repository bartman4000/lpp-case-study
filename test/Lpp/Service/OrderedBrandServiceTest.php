<?php

/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

use Lpp\Entity\Item;
use Lpp\Service\ItemService;
use Lpp\Service\ItemServiceInterface;
use Lpp\Service\OrderedBrandService;

class OrderedBrandServiceTest extends AbstractServiceTest
{
    /**
     * @var ItemServiceInterface
     */
    private $itemService;

    public function setUp()
    {
        $mockItem1 = $this->getItemMock('trench-coat');
        $mockItem2 = $this->getItemMock('jacket');
        $mockItem3 = $this->getItemMock('shoes');
        $mockBrand1 = $this->getBrandMock('brandB', [$mockItem1, $mockItem2, $mockItem3]);

        $mockItem4 = $this->getItemMock('coat');
        $mockItem5 = $this->getItemMock('hat');
        $mockItem6 = $this->getItemMock('dress');
        $mockBrand2 = $this->getBrandMock('brandA', [$mockItem4, $mockItem5, $mockItem6]);

        $mockData = array(
            $mockBrand1,
            $mockBrand2,
        );

        $this->itemService = $this->createMock(ItemService::class);
        $this->itemService
            ->expects(self::exactly(1))
            ->method('getResultForCollectionId')
            ->with(1315475)
            ->willReturn($mockData);
    }

    public function testGetItemsForCollectionWithCallableSorter()
    {
        $sorter = function (Item $item1, Item $item2) {
            return strcmp($item1->name, $item2->name);
        };

        $brandService = new OrderedBrandService($this->itemService);
        $brandService->setItemSortCallable($sorter);
        $items = $brandService->getItemsForCollection('winter');

        $this->assertCount(6, $items);
        $this->assertInstanceOf(Item::class, $items[0]);
        $this->assertEquals('coat', $items[0]->name);
        $this->assertEquals('dress', $items[1]->name);
        $this->assertEquals('hat', $items[2]->name);
        $this->assertEquals('jacket', $items[3]->name);
        $this->assertEquals('shoes', $items[4]->name);
        $this->assertEquals('trench-coat', $items[5]->name);
    }
}
