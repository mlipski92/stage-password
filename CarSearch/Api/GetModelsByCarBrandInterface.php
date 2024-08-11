<?php

namespace Mlipski\CarSearch\Api;

interface GetModelsByCarBrandInterface
{
    /**
     * @param string $carBrand
     * @return array
     */
    public function getModelsByCarBrandInterface(string $carBrand);
}
