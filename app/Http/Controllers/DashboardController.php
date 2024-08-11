<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        $totalBuku = Buku::count(); // Menghitung total buku
        $totalKategori = Kategori::count(); // Menghitung total kategori
        $totalBukuTersedia = Buku::where('jumlah', '>', 0)->count(); // Menghitung total buku yang tersedia
    
        return view('admin.dashboard', compact('totalBuku', 'totalKategori', 'totalBukuTersedia'));
    }

public function indexUser()
{
    $userId = auth()->id(); // Mendapatkan ID pengguna yang sedang login

    $totalBuku = Buku::where('user_id', $userId)->count(); // Menghitung total buku untuk pengguna ini
    $totalKategori = Kategori::where('user_id', $userId)->count(); // Menghitung total kategori untuk pengguna ini
    $totalBukuTersedia = Buku::where('user_id', $userId)->where('jumlah', '>', 0)->count(); // Menghitung total buku yang tersedia

    return view('user.dashboard', compact('totalBuku', 'totalKategori', 'totalBukuTersedia'));
}

}
