<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */


namespace Lpp\Service;

class OrderedBrandService extends UnorderedBrandService
{
    /** @var callable|null */
    protected $brandSortCallable = null;

    /** @var callable|null */
    protected $itemSortCallable = null;

    public function getItemsForCollection(string $collectionName): array
    {
        $items = parent::getItemsForCollection($collectionName);
        if (!is_null($this->itemSortCallable)) {
            usort($items, $this->itemSortCallable);
        }
        return $items ;
    }

    public function getBrandsForCollection(string $collectionName): array
    {
        $items = parent::getBrandsForCollection($collectionName);
        if (!is_null($this->brandSortCallable)) {
            usort($items, $this->brandSortCallable);
        }
        return $items ;
    }

    /**
     * @param callable $brandSortCallable
     */
    public function setBrandSortCallable(callable $brandSortCallable)
    {
        $this->brandSortCallable = $brandSortCallable;
    }

    /**
     * @param callable $itemSortCallable
     */
    public function setItemSortCallable(callable $itemSortCallable)
    {
        $this->itemSortCallable = $itemSortCallable;
    }
}
