<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        // Tarik data dari database
        $alternatif = Alternatif::all(); 
        return view('alternatif.index', compact('alternatif'));
    }
}