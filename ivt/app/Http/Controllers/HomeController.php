<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\Ticket;
use App\CommodityLocation;
use App\Repositories\CommodityAcquisitionRepository;
use App\Repositories\CommodityRepository;
use App\Repositories\TiketRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        public CommodityRepository $commodityRepository,
        public TiketRepository $tiketRepository,
        public CommodityAcquisitionRepository $commodityAcquisitionRepository
    ) {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ticket = Ticket::orderBy('status', 'DESC')->get();
        $commodity_order_by_price = Commodity::orderBy('price', 'DESC')->take(5)->get();
        $commodity_condition_count = $this->commodityRepository->countCommodityCondition()->map(function ($commodity) {
            return collect([
                'condition_name' => $commodity->getConditionName(),
                'count' => $commodity->count,
            ]);
        });

        $commodity_counts = [
            'commodity_in_total' => $commodity_condition_count->sum('count') ?? 0,
            'commodity_in_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Baik')['count'] ?? 0,
            'commodity_in_not_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Kurang Baik')['count'] ?? 0,
            'commodity_in_heavily_damage_condition' => $commodity_condition_count->firstWhere('condition_name', 'Rusak Berat')['count'] ?? 0,
        ];

        $commodity_each_year_of_purchase_count = $this->commodityRepository->countCommodityEachYear();
        $commodity_each_location_count = CommodityLocation::has('commodities')->withCount('commodities')->get();
        $commodity_by_commodity_acquisition_count = $this->commodityAcquisitionRepository
            ->countCommodityByCommodityAcquisition();
        // $commodity_by_material_count = $this->commodityRepository->countCommodityByMaterial()->map(function ($commodity) {
        //     return collect([
        //         'name' => $commodity->material,
        //         'material_count' => $commodity->count,
        //     ]);
        // });
        $commodity_by_brand_count = $this->commodityRepository->countCommodityByBrand()->map(function ($commodity) {
            return collect([
                'name' => $commodity->brand,
                'brand_count' => $commodity->count,
            ]);
        });

        $charts = [
            'commodity_condition_count' => [
                'categories' => $commodity_condition_count->pluck('condition_name'),
                'series' => $commodity_condition_count->pluck('count'),
            ],
            'commodity_each_year_of_purchase_count' => [
                'categories' => $commodity_each_year_of_purchase_count->pluck('year_of_purchase'),
                'series' => $commodity_each_year_of_purchase_count->pluck('count'),
            ],
            'commodity_each_location_count' => [
                'categories' => $commodity_each_location_count->pluck('name'),
                'series' => $commodity_each_location_count->pluck('commodities_count'),
            ],
            'commodity_by_commodity_acquisition_count' => [
                'categories' => $commodity_by_commodity_acquisition_count->pluck('name'),
                'series' => $commodity_by_commodity_acquisition_count->pluck('commodities_count'),
            ],
            // 'commodity_by_material_count' => [
            //     'categories' => $commodity_by_material_count->pluck('name'),
            //     'series' => $commodity_by_material_count->pluck('material_count'),
            // ],
            'commodity_by_brand_count' => [
                'categories' => $commodity_by_brand_count->pluck('name'),
                'series' => $commodity_by_brand_count->pluck('brand_count'),
            ],
        ];

        // START check public IP Honda MTH
        $hondaMth = '202.51.101.206';

        // Check connection status (ping port 8291)
        $connectionStatus = false;
        $conn = @fsockopen($hondaMth, 8291, $errno, $errstr, 2);
        if ($conn) {
            $connectionStatus = true;
            fclose($conn);
        }
        // END check public IP

        // START check public IP Honda Bekasi
        $hondaBks = '202.51.99.222';

        // Check connection status (ping port 8291)
        $connectionStatus1 = false;
        $conn1 = @fsockopen($hondaBks, 8291, $errno, $errstr, 2);
        if ($conn1) {
            $connectionStatus1 = true;
            fclose($conn1);
        }
        // END check public IP

        // START check public IP Mercedes
        $merceMth = '202.51.103.154';

        // Check connection status (ping port 8291)
        $connectionStatus2 = false;
        $conn2 = @fsockopen($merceMth, 8291, $errno, $errstr, 2);
        if ($conn2) {
            $connectionStatus2 = true;
            fclose($conn2);
        }
        // END check public IP

        // START check public IP RE Antas
        $reAts = '103.168.188.146';

        // Check connection status (ping port 8291)
        $connectionStatus3 = false;
        $conn3 = @fsockopen($reAts, 8291, $errno, $errstr, 2);
        if ($conn3) {
            $connectionStatus3 = true;
            fclose($conn3);
        }
        // END check public IP

        // START check public IP OtoBitz MTH
        $otobitzMth = '202.51.103.154';

        // Check connection status (ping port 1433)
        $connectionStatus4 = false;
        $conn4 = @fsockopen($otobitzMth, 1433, $errno, $errstr, 2);
        if ($conn4) {
            $connectionStatus4 = true;
            fclose($conn4);
        }
        // END check public IP

        // START check public IP OtoBitz BKS
        $otobitzBks = '202.51.99.222';

        // Check connection status (ping port 1433)
        $connectionStatus5 = false;
        $conn5 = @fsockopen($otobitzBks, 1433, $errno, $errstr, 2);
        if ($conn5) {
            $connectionStatus5 = true;
            fclose($conn5);
        }
        // END check public IP

        // START check public IP Odoo MTH
        $odooMth = '202.51.103.154';

        // Check connection status (ping port 8333)
        $connectionStatus6 = false;
        $conn6 = @fsockopen($odooMth, 8333, $errno, $errstr, 2);
        if ($conn6) {
            $connectionStatus6 = true;
            fclose($conn6);
        }
        // END check public IP

        // START check public IP Otobitz SMD
        $otobitzSmd = 'hondanusantarasmd.ddns.net';

        // Check connection status (ping port 8333)
        $connectionStatus7 = false;
        $conn7 = @fsockopen($otobitzSmd, 8333, $errno, $errstr, 2);
        if ($conn7) {
            $connectionStatus7 = true;
            fclose($conn7);
        }
        // END check public IP

        return view(
            'home',
            compact(
                'commodity_order_by_price',
                'commodity_counts',
                'charts',
                'hondaMth',
                'hondaBks',
                'merceMth',
                'reAts',
                'otobitzMth',
                'otobitzBks',
                'odooMth',
                'otobitzSmd',
                'connectionStatus1',
                'connectionStatus2',
                'connectionStatus3',
                'connectionStatus4',
                'connectionStatus5',
                'connectionStatus6',
                'connectionStatus7',
                'connectionStatus'
            )
        );
    }

    public function getOtobitzMth()
    {
        $connectionString4 = 'Otobitz SMD';
        $otobitzMth = '202.51.103.154';  // fetch latest value here
        $connectionStatus4 = false;
        $conn4 = @fsockopen($otobitzMth, 1433, $errno, $errstr, 2);
        if ($conn4) {
            $connectionStatus4 = true;
            fclose($conn4);
        }  // fetch latest status here
        return response()->json([
            'connectionString4' => $connectionString4,
            'otobitzMth' => $otobitzMth,
            'connectionStatus4' => $connectionStatus4
        ]);
    }

    public function getOtobitzBks()
    {
        $connectionString5 = 'Otobitz BKS';
        $otobitzBks = '202.51.99.222';  // fetch latest value here
        $connectionStatus5 = false;
        $conn5 = @fsockopen($otobitzBks, 1433, $errno, $errstr, 2);
        if ($conn5) {
            $connectionStatus5 = true;
            fclose($conn5);
        }  // fetch latest status here
        return response()->json([
            'connectionString5' => $connectionString5,
            'otobitzBks' => $otobitzBks,
            'connectionStatus5' => $connectionStatus5
        ]);
    }

    public function getMerceMth()
    {
        $merceMth = '202.51.103.154';  // fetch latest value here
        $connectionStatus2 = false;
        $conn2 = @fsockopen($merceMth, 8291, $errno, $errstr, 2);
        if ($conn2) {
            $connectionStatus2 = true;
            fclose($conn2);
        }  // fetch latest status here
        return response()->json([
            'merceMth' => $merceMth,
            'connectionStatus2' => $connectionStatus2
        ]);
    }

    public function getReAts()
    {
        $reAts = '103.168.188.146';  // fetch latest value here
        $connectionStatus3 = false;
        $conn3 = @fsockopen($reAts, 8291, $errno, $errstr, 2);
        if ($conn3) {
            $connectionStatus3 = true;
            fclose($conn3);
        }  // fetch latest status here
        return response()->json([
            'reAts' => $reAts,
            'connectionStatus3' => $connectionStatus3
        ]);
    }

    public function getHondaMth()
    {
        $hondaMth = '202.51.101.206';  // fetch latest value here
        $connectionStatus = false;
        $conn = @fsockopen($hondaMth, 8291, $errno, $errstr, 2);
        if ($conn) {
            $connectionStatus = true;
            fclose($conn);
        }  // fetch latest status here
        return response()->json([
            'hondaMth' => $hondaMth,
            'connectionStatus' => $connectionStatus
        ]);
    }

    public function getHondaBks()
    {
        $hondaBks = '202.51.99.222';  // fetch latest value here
        $connectionStatus1 = false;
        $conn1 = @fsockopen($hondaBks, 8291, $errno, $errstr, 2);
        if ($conn1) {
            $connectionStatus1 = true;
            fclose($conn1);
        }  // fetch latest status here
        return response()->json([
            'hondaBks' => $hondaBks,
            'connectionStatus1' => $connectionStatus1
        ]);
    }

    public function getOdooMth()
    {
        $connectionString6 = 'Odoo MTH';
        $odooMth = '202.51.103.154';  // fetch latest value here
        $connectionStatus6 = false;
        $conn6 = @fsockopen($odooMth, 8333, $errno, $errstr, 2);
        if ($conn6) {
            $connectionStatus6 = true;
            fclose($conn6);
        }  // fetch latest status here
        return response()->json([
            'connectionString6' => $connectionString6,
            'odooMth' => $odooMth,
            'connectionStatus6' => $connectionStatus6
        ]);
    }

    public function getOtobitzSmd()
    {
        $connectionString7 = 'Otobitz MTH';
        $otobitzSmd = 'hondanusantarasmd.ddns.net';  // fetch latest value here
        $connectionStatus7 = false;
        $conn7 = @fsockopen($otobitzSmd, 8333, $errno, $errstr, 2);
        if ($conn7) {
            $connectionStatus7 = true;
            fclose($conn7);
        }  // fetch latest status here
        return response()->json([
            'connectionString7' => $connectionString7,
            'otobitzSmd' => $otobitzSmd,
            'connectionStatus7' => $connectionStatus7
        ]);
    }
}
