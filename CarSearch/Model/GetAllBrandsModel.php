<?php

namespace Mlipski\CarSearch\Model;


use Mlipski\CarSearch\Api\GetAllBrandsInterface;
use Magento\Eav\Api\AttributeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory as AttributeSetCollectionFactory;


class GetAllBrandsModel implements GetAllBrandsInterface
{

    protected $attributeRepository;
    protected $attributeSetCollectionFactory;
    protected $searchCriteriaBuilder;
    protected $filterBuilder;

    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        AttributeSetCollectionFactory $attributeSetCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->attributeSetCollectionFactory = $attributeSetCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }



    public function getAllBrands()
    {

        $filter = $this->filterBuilder
        ->setField('attribute_code')
        ->setValue('mlipski_cars%')
        ->setConditionType('like')
        ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$filter])
            ->create();

        $attributes = $this->attributeRepository->getList(\Magento\Catalog\Model\Product::ENTITY, $searchCriteria);
        $collectCarBrands = [];

        foreach($attributes->getItems() as $attribute) {
            $composeCarBrandItem = [
                'code' => $attribute->getAttributeCode(),
                'label' => $attribute->getFrontendLabel()
            ];
            array_push($collectCarBrands, $composeCarBrandItem);
        }

        return $collectCarBrands;

    }
}