<?php

namespace App\Repositories;

use App\Pc;

class PcRepository
{
    public function __construct(
        private Pc $model
    ) {}

    /**
     * Count pc based on different hostname.
     */
    public function countPcAll()
    {
        return $this->model->selectRaw('`hostname`, COUNT(`hostname`) AS count')
            ->groupBy('hostname')
            ->get();
    }
    /**
     * Count pc based by jenis.
     */
    public function countPcByType()
    {
        return $this->model->selectRaw('`jenis`, COUNT(`jenis`) AS count')
            ->groupBy('jenis')
            ->get();
    }

    /**
     * Count pc for each year of purchase.
     */
    public function countCommodityEachYear()
    {
        return $this->model->selectRaw('COUNT(`year_of_purchase`) AS count, year_of_purchase')
            ->groupBy('year_of_purchase')
            ->orderBy('year_of_purchase')
            ->get();
    }

    /**
     * Count the number of pc grouped by material.
     */
    // public function countCommodityByMaterial()
    // {
    //     return $this->model->selectRaw('COUNT(`material`) AS count, material')
    //         ->groupBy('material')
    //         ->orderBy('material')
    //         ->get();
    // }

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
