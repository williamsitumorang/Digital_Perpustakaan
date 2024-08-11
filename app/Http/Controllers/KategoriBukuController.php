<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KategoriBukuController extends Controller
{
    public function index() {
        $kategoris = Kategori::where('user_id', auth()->id())->get();

        return view('user.kategori.data_kategori', compact('kategoris'));
    }

    public function tambahKategori() {
        return view('user.kategori.tambah_kategori');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Menyimpan kategori
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->user_id = auth()->id();
        $kategori->save();

        return redirect()->route('user.kategori_buku')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('user.kategori.edit_kategori', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mengupdate kategori
        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();

        return redirect()->route('user.kategori_buku')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('user.kategori_buku')->with('success', 'Kategori berhasil dihapus.');
    }
}
