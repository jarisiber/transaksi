<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Karyawans;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKaryawanRequest;

class KaryawanController extends Controller
{
    public function __construct(
        
    ) {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawans::orderBy('employee_id', 'DESC')
                ->get();
        return view('karyawans.index',
            compact(
                'karyawan'
            )
        );
    }
    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKaryawanRequest $request)
    {
        Karyawans::create($request->validated());

        return to_route('karyawan.index')->with('success', 'Data berhasil ditambahkan!');
    }
}
