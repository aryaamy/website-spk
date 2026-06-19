<?php

namespace App\Http\Controllers;

use App\Models\Kriteria; // Panggil modelnya biar bisa narik data
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        // Tarik semua data dari tabel kriteria
        $kriteria = Kriteria::all(); 
        
        // Lempar datanya ke halaman view 'kriteria.index'
        return view('kriteria.index', compact('kriteria'));
    }
}