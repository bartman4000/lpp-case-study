<?php
namespace Lpp\Service;

use Lpp;

class UnorderedBrandService implements BrandServiceInterface
{
    /**
     * @var ItemServiceInterface
     */
    private $itemService;

    /**
     * Maps from collection name to the id for the item service.
     *
     * @var []
     */
    private $collectionNameToIdMapping = [
            "winter" => 1315475
        ];

    /**
     * @param ItemServiceInterface $itemService
     */
    public function __construct(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @param string $collectionName Name of the collection to search for.
     *
     * @return \Lpp\Entity\Brand[]
     */
    public function getBrandsForCollection(string $collectionName): array
    {
        if (empty($this->collectionNameToIdMapping[$collectionName])) {
            throw new \InvalidArgumentException(sprintf('Provided collection name [%s] is not mapped.', $collectionName));
        }

        $collectionId = $this->collectionNameToIdMapping[$collectionName];
        return $this->itemService->getResultForCollectionId($collectionId);
    }


    /**
     * This is supposed to be used for testing purposes.
     * You should avoid replacing the item service at runtime.
     *
     * @param \Lpp\Service\ItemServiceInterface $itemService
     *
     * @return void
     */
    public function setItemService(ItemServiceInterface $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @param string $collectionName Name of a collection to search for
     *
     * @return \Lpp\Entity\Item[]
     */
    public function getItemsForCollection(string $collectionName): array
    {
        $brands = $this->getBrandsForCollection($collectionName);
        $items = [];
        foreach ($brands as $brand) {
            $items = array_merge($items, $brand->items);
        }
        return $items;
    }
}
