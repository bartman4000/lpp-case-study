<?php
/**
 * Copyright (c) Bartłomiej Olewiński <bartlomiej.olewinski@gmail.com>
 */

namespace Lpp\Service;

use JMS\Serializer\SerializerInterface;
use Lpp\Entity\Collection;

class ItemService implements ItemServiceInterface
{
    const PATH = __DIR__.'/../../../data';

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * ItemService constructor.
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * This method should read from a datasource (JSON for case study)
     * and should return an unsorted list of brands found in the datasource.
     *
     * @param int $collectionId
     *
     * @return \Lpp\Entity\Brand[]
     */
    public function getResultForCollectionId(int $collectionId): array
    {
        $data = $this->getData($collectionId);

        /** @var Collection $collection */
        $collection = $this->serializer->deserialize($data, Collection::class, 'json', null);
        return $collection->getBrands();
    }

    /**
     * @param int $collectionId
     * @return string
     */
    protected function getData(int $collectionId): string
    {
        $path = self::PATH.'/'.$collectionId.'.json';
        return $data = file_get_contents($path);
    }
}
