<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;

class AuthController extends Controller
{
    // Form Login Admin
    public function login()
    {
        return view('auth.login');
    }

    // Proses Login Admin
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Arahin ke dashboard
        }

        return back()->withErrors(['email' => 'Email atau password salah cuy!'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Portal Pencarian Mahasiswa
    public function portal()
    {
        return view('portal.index');
    }

    public function cariNim(Request $request)
    {
        $request->validate(['nim' => 'required']);
        
        // 1. Cek apakah NIM-nya ada di database
        $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

        if ($mahasiswa) {
            // 2. Kalau NIM ada, cek apakah nilai transkripnya udah diinput admin
            $cek_nilai = \App\Models\NilaiStudi::where('mahasiswa_id', $mahasiswa->id)->count();

            if ($cek_nilai > 0) {
                // Kalau nilainya udah ada, lempar ke halaman rapor PDF
                return redirect('/perhitungan/' . $mahasiswa->id);
            } else {
                // Kalau NIM ada tapi nilainya kosong (belum diinput)
                return back()->with('error', 'NIM ditemukan, tapi data Anda masih dalam proses penilaian oleh Admin Prodi. Silakan cek lagi nanti!');
            }
        }

        // 3. Kalau NIM-nya emang nggak pernah didaftarin sama sekali
        return back()->with('error', 'NIM tidak terdaftar di sistem! Pastikan Anda memasukkan NIM dengan benar.');
    }
}