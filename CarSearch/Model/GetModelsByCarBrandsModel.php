<?php

namespace Mlipski\CarSearch\Model;

use Mlipski\CarSearch\Api\GetModelsByCarBrandInterface;

use Magento\Eav\Api\AttributeSetRepositoryInterface;
use Magento\Eav\Api\AttributeRepositoryInterface;


class GetModelsByCarBrandsModel implements GetModelsByCarBrandInterface
{

    protected $attributeRepository;


    public function __construct(
        AttributeSetRepositoryInterface $attributeSetRepository,
        AttributeRepositoryInterface $attributeRepository,
    ) {
        $this->attributeSetRepository = $attributeSetRepository;
        $this->attributeRepository = $attributeRepository;
    }


    public function getModelsByCarBrandInterface(string $carBrand) 
    {
        $attribute = $this->attributeRepository->get(
            \Magento\Catalog\Api\Data\ProductAttributeInterface::ENTITY_TYPE_CODE,
            $carBrand
        );

        $attributeOptions = $attribute->getOptions();
        $separatedOptions = [];

        foreach ($attributeOptions as $option) {
            $composeOption = [
                'label' => $option->getLabel(),
                'id' => $option->getValue()
            ];

            if ($composeOption['id'] != "") {
                array_push($separatedOptions, $composeOption);
            }
            
        }

        return $separatedOptions;

   


    }
}
