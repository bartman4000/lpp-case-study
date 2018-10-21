<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

use JMS\Serializer\Serializer;
use Lpp\Entity\Brand;
use Lpp\Entity\Collection;
use Lpp\Service\ItemService;

class ItemServiceTest extends AbstractServiceTest
{
    public function testGetResultForCollectionId()
    {
        $mockJson = '{
    "collection": "spring",
    "id": 12345,
    "brands": {
        "1": {
            "name": "spring1",
            "description": "New spring collection",
            "items": {
                "1000": {
                    "name": "jacket",
                    "url": "http://www.example.com",
                    "prices": {
                        "12": {
                            "description": "Initial price",
                            "priceInEuro": 160,
                            "arrival": "2019-01-03",
                            "due": "2019-01-20"
                        }
                    }
                }
            }
        }
    }
}';
        $mockBrand1 = $this->getBrandMock('brand1');
        $mockBrand2 = $this->getBrandMock('brand2');
        $mockCollection = $this->getCollectionMock('spring', 12345, [$mockBrand1, $mockBrand2]);

        $serializerMock = $this->createMock(Serializer::class);
        $serializerMock
            ->expects(self::exactly(1))
            ->method('deserialize')
            ->with($mockJson, Collection::class, 'json', null)
            ->willReturn($mockCollection);

        /** @var PHPUnit_Framework_MockObject_MockObject|\Lpp\Service\ItemService $itemService */
        $itemService = $this->getMockBuilder(ItemService::class)
            ->setConstructorArgs(array($serializerMock))
            ->setMethods(array('getData'))
            ->getMock();

        $itemService
            ->expects(self::exactly(1))
            ->method('getData')
            ->willReturn($mockJson);

        $results = $itemService->getResultForCollectionId(12345);
        $this->assertCount(2, $results);
        $this->assertInstanceOf(Brand::class, $results[0]);
    }
}
