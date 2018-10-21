<?php

/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

use Lpp\Entity\Brand;
use Lpp\Entity\Item;
use Lpp\Service\ItemService;
use Lpp\Service\ItemServiceInterface;
use Lpp\Service\UnorderedBrandService;

class UnorderedBrandServiceTest extends AbstractServiceTest
{
    /**
     * @var ItemServiceInterface
     */
    private $itemService;

    public function setUp()
    {
        $mockItem1 = $this->getItemMock('item1');
        $mockItem2 = $this->getItemMock('item2');
        $mockBrand = $this->getBrandMock('brand1', [$mockItem1, $mockItem2]);
        $mockData = array(
            $mockBrand
        );

        $this->itemService = $this->createMock(ItemService::class);
        $this->itemService
            ->expects(self::exactly(1))
            ->method('getResultForCollectionId')
            ->with(1315475)
            ->willReturn($mockData);
    }

    public function testGetBrandsForCollection()
    {
        $brandService = new UnorderedBrandService($this->itemService);
        $brands = $brandService->getBrandsForCollection('winter');

        $this->assertCount(1, $brands);
        $this->assertInstanceOf(Brand::class, $brands[0]);
    }

    public function testGetItemsForCollection()
    {
        $brandService = new UnorderedBrandService($this->itemService);
        $items = $brandService->getItemsForCollection('winter');

        $this->assertCount(2, $items);
        $this->assertInstanceOf(Item::class, $items[0]);
        $this->assertEquals('item2', $items[1]->name);
    }
}
