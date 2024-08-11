<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function indexAdmin()
    {
        $bukus = Buku::all(); // Ambil semua data buku dari database
        $kategoris = Kategori::all(); // Ambil kategori milik user
        return view('admin.data_buku', compact('bukus', 'kategoris'));
    }


    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        
        // Hapus file jika ada
        if ($buku->file_buku) {
            unlink(public_path('uploads/buku/' . $buku->file_buku));
        }
        if ($buku->cover_buku) {
            unlink(public_path('uploads/covers/' . $buku->cover_buku));
        }
    
        $buku->delete();
    
        return redirect()->route('admin.data_buku_admin')->with('success', 'Buku berhasil dihapus.');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.edit_buku', compact('buku','kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'kategori_buku' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'file_buku' => 'nullable|mimes:pdf|max:2048',
            'cover_buku' => 'nullable|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Mencari buku berdasarkan ID
        $buku = Buku::findOrFail($id);
        $buku->judul_buku = $request->judul_buku;
        $buku->kategori_buku = $request->kategori_buku;
        $buku->deskripsi = $request->deskripsi;
        $buku->jumlah = $request->jumlah;

        // Menyimpan file buku jika diupload
        if ($request->hasFile('file_buku')) {
            // Hapus file lama jika ada
            if ($buku->file_buku) {
                unlink(public_path('uploads/buku/' . $buku->file_buku));
            }
            
            $fileBuku = $request->file('file_buku');
            $fileName = time() . '_' . $fileBuku->getClientOriginalName();
            $fileBuku->move(public_path('uploads/buku'), $fileName);
            $buku->file_buku = $fileName;
        }

        // Menyimpan cover buku jika diupload
        if ($request->hasFile('cover_buku')) {
            // Hapus cover lama jika ada
            if ($buku->cover_buku) {
                unlink(public_path('uploads/covers/' . $buku->cover_buku));
            }

            $coverBuku = $request->file('cover_buku');
            $coverName = time() . '_' . $coverBuku->getClientOriginalName();
            $coverBuku->move(public_path('uploads/covers'), $coverName);
            $buku->cover_buku = $coverName;
        }

        $buku->save();

        return redirect()->route('admin.data_buku_admin')->with('success', 'Buku berhasil diperbarui.');
    }

    public function exportPDFAll()
    {
        $bukus = Buku::all();
    
        // Membuat instansi PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.export_pdf', compact('bukus'));
    
        return $pdf->download('data_buku.pdf');
    }
    
}
