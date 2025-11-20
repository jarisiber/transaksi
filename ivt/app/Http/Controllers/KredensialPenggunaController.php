<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KredensialPengguna;

class KredensialPenggunaController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    
    public function index()
    {
        $kredensialPengguna = KredensialPengguna::orderBy('nama_pengguna', 'ASC')->get();

        return view('kredensial-penggunas.index', compact('kredensialPengguna'));
    }
}
