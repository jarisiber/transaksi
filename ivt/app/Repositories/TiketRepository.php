<?php

namespace App\Repositories;

use App\Ticket;

class TiketRepository
{
    public function __construct(
        private Ticket $model
    ) {}

    /**
     * Count tiket based on different no tiket.
     */
    public function countTiketAll()
    {
        return $this->model->selectRaw('`no_tiket`, COUNT(`no_tiket`) AS count')
            ->groupBy('no_tiket')
            ->get();
    }
    /**
     * Count tiket based by status.
     */
    public function countTicketStatus()
    {
        return $this->model->selectRaw('`status`, COUNT(`status`) AS count')
            ->groupBy('status')
            ->get();
    }
    /**
     * Count tiket based by prioritas.
     */
    // public function countTiketByJenisDukungan()
    // {
    //     return $this->model->selectRaw('`jenis_dukungan`, COUNT(`jenis_dukungan`) AS count')
    //         ->groupBy('jenis_dukungan')
    //         ->get();
    // }

    /**
     * Count tiket for each year of purchase.
     */
    public function countCommodityEachYear()
    {
        return $this->model->selectRaw('COUNT(`year_of_purchase`) AS count, year_of_purchase')
            ->groupBy('year_of_purchase')
            ->orderBy('year_of_purchase')
            ->get();
    }

    /**
     * Count the number of tiket grouped by material.
     */
    // public function countCommodityByMaterial()
    // {
    //     return $this->model->selectRaw('COUNT(`material`) AS count, material')
    //         ->groupBy('material')
    //         ->orderBy('material')
    //         ->get();
    // }

    /**
     * Count the number of tiket grouped by brand.
     */
    public function countCommodityByBrand()
    {
        return $this->model->selectRaw('COUNT(`brand`) AS count, brand')
            ->groupBy('brand')
            ->orderBy('brand')
            ->get();
    }
}
