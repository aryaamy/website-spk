<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Tambahin baris ini biar Laravel baca tabel 'kriteria', bukan 'kriterias'
    protected $table = 'kriteria'; 
    protected $guarded = []; // Biar semua kolom bisa diisi (mass assignment)
}