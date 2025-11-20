<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wifi;
use App\Repositories\WifiRepository;

class WifiController extends Controller
{
    public function __construct(
        private WifiRepository $wifiRepository,
    )
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $wifi = Wifi::orderBy('is_active', 'DESC')->get();

        $wifi_condition_count = $this->wifiRepository->countWifiAll()->map(function ($wifi) {
            return collect([
                'is_active' => $wifi->getWifiCondition(),
                'count' => $wifi->count,
            ]);
        });
        
        $wifi_counts = [
            'wifi_in_total' => $wifi_condition_count->sum('count') ?? 0,
            'wifi_active' => $wifi_condition_count->firstWhere('is_active', 'Active')['count'] ?? 0,
            'wifi_in_active' => $wifi_condition_count->firstWhere('is_active', 'In-Active')['count'] ?? 0,
            'wifi_in_NA' => $wifi_condition_count->firstWhere('is_active', 'NA')['count'] ?? 0,
        ];

        return view(
            'wifis.index', 
            compact(
                'wifi',
                'wifi_counts'
            )
        );
    }
}
