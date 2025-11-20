<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePcRequest;
use App\Pc;
use App\CommodityLocation;
use App\Repositories\PcRepository;

class PcController extends Controller
{
    public function __construct(
        private PcRepository $pcRepository,
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pc = Pc::orderBy('processor', 'DESC')->get();
        $branches = CommodityLocation::orderBy('name')->pluck('name', 'id');

        $pc_count_all = $this->pcRepository->countPcAll()->map(function ($pc) {
            return collect([
                'hostname' => $pc->hostname,
                'count' => $pc->count,
            ]);
        });

        $pc_desktop_count = $this->pcRepository->countPcByType('Desktop')->map(function ($pc) {
            return collect([
                'jenis' => $pc->jenis,
                'count' => $pc->count,
            ]);
        });

        $pc_counts = [
            'pc_in_total' => $pc_count_all->sum('count') ?? 0,
            'pc_desktop_total' => $pc_desktop_count->firstWhere('jenis', 'Desktop')['count'] ?? 0,
            'pc_laptop_total' => $pc_desktop_count->firstWhere('jenis', 'Laptop')['count'] ?? 0,
            'pc_server_total' => $pc_desktop_count->firstWhere('jenis', 'Server')['count'] ?? 0,
        ];

        return view(
            'pcs.index', 
            compact(
                'pc',
                'branches',
                'pc_counts'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePcRequest $request)
    {
        Pc::create($request->validated());

        return to_route('pc.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
