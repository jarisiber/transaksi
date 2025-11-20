<?php

namespace App\Repositories;

use App\Branch;

class BranchRepository
{
    public function __construct(
        private Branch $model
    ) {}

    /**
     * Count branch based on different is_active.
     */
    public function countBranchAll()
    {
        return $this->model->selectRaw('`is_active`, COUNT(`is_active`) AS count')
            ->groupBy('is_active')
            ->get();
    }

    /**
     * Count commodities for each year of purchase.
     */
    public function countCommodityEachYear()
    {
        return $this->model->selectRaw('COUNT(`year_of_purchase`) AS count, year_of_purchase')
            ->groupBy('year_of_purchase')
            ->orderBy('year_of_purchase')
            ->get();
    }

    /**
     * Count the number of commodities grouped by material.
     */
    public function countCommodityByMaterial()
    {
        return $this->model->selectRaw('COUNT(`material`) AS count, material')
            ->groupBy('material')
            ->orderBy('material')
            ->get();
    }

    /**
     * Count the number of commodities grouped by brand.
     */
    public function countCommodityByBrand()
    {
        return $this->model->selectRaw('COUNT(`brand`) AS count, brand')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();
    }
}
