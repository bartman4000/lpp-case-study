<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Lpp\Serializer\SerializerFactory;
use Lpp\Service\ItemService;
use Lpp\Service\UnorderedBrandService;

$autoloader = require_once __DIR__ . '/vendor/autoload.php';

/** to allow Serializer use annontations on Entities */
AnnotationRegistry::registerLoader(array($autoloader, "loadClass"));

error_reporting(E_ALL);

$itemService = new ItemService(SerializerFactory::build());

$items = $itemService->getResultForCollectionId(1315475);

//$brandService = new UnorderedBrandService($itemService);
//$brands = $brandService->getBrandsForCollection("winter");
//$items = $brandService->getItemsForCollection("winter");

print_r($items);exit();