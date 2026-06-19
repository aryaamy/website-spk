<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // 1. Nampilin tabel mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    // 2. Nampilin form tambah data
    public function create()
    {
        return view('mahasiswa.create');
    }

    // 3. Proses nyimpen data ke database
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'kelas' => 'required'
        ]);

        Mahasiswa::create($request->all());
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambah!');
    }

    // Tambahin fungsi edit (nampilin form edit)
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Tambahin fungsi update (nyimpen editan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'kelas' => 'required'
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());
        
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil diupdate!');
    }

    // Tambahin fungsi destroy (hapus data)
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        // Opsional: Hapus juga nilai transkripnya biar nggak jadi file sampah di database
        \App\Models\NilaiStudi::where('mahasiswa_id', $id)->delete(); 
        
        $mahasiswa->delete();
        return redirect('/mahasiswa')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}