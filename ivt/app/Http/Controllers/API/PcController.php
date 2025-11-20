<?php

namespace App\Http\Controllers\API;

use App\Pc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PcController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Pc $pc)
    {
        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => 'success',
            'data' => $pc,
        ], Response::HTTP_OK);
    }
}