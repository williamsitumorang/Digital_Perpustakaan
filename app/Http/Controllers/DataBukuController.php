<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DataBukuController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::where('user_id', auth()->id())->get(); // Ambil kategori milik user
        $bukus = Buku::where('user_id', auth()->id());
    
        // Filter berdasarkan kategori jika ada
        if ($request->has('kategori_id') && $request->kategori_id != '') {
            $bukus = $bukus->where('kategori_buku', $request->kategori_id);
        }
    
        $bukus = $bukus->get();
    
        return view('user.data_buku', compact('bukus', 'kategoris'));
    }


    public function tambahBuku() {
            // Ambil kategori buku yang hanya dimiliki oleh user yang sedang login
    $kategoris = Kategori::where('user_id', auth()->id())->get();
    
    return view('user.tambah_buku', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul_buku' => 'required|string|max:255',
            'kategori_buku' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'file_buku' => 'required|mimes:pdf|max:2048',
            'cover_buku' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Menyimpan data buku
            $buku = new Buku();
            $buku->judul_buku = $request->judul_buku;
            $buku->kategori_buku = $request->kategori_buku;
            $buku->deskripsi = $request->deskripsi;
            $buku->jumlah = $request->jumlah;


            // Menyimpan file buku
            if ($request->hasFile('file_buku')) {
                $fileBuku = $request->file('file_buku');
                $fileName = time() . '_' . $fileBuku->getClientOriginalName();
                $fileBuku->move(public_path('uploads/buku'), $fileName);
                $buku->file_buku = $fileName;
            }

            // Menyimpan cover buku
            if ($request->hasFile('cover_buku')) {
                $coverBuku = $request->file('cover_buku');
                $coverName = time() . '_' . $coverBuku->getClientOriginalName();
                $coverBuku->move(public_path('uploads/covers'), $coverName);
                $buku->cover_buku = $coverName;
            }
            $buku->user_id = auth()->id();

            // Simpan buku
            $buku->save();

            return redirect()->route('user.data_buku')->with('success', 'Buku berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Menangani kesalahan saat menyimpan buku
            return redirect()->back()->with('failed', 'Buku gagal ditambahkan. Silakan coba lagi.')->withInput();
        }
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
    
        return redirect()->route('user.data_buku')->with('success', 'Buku berhasil dihapus.');
    }

    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::where('user_id', auth()->id())->get();
        return view('user.edit', compact('buku', 'kategoris'));
    }

    public function updateBuku(Request $request, $id)
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

        return redirect()->route('user.data_buku')->with('success', 'Buku berhasil diperbarui.');
    }

    public function exportPDF()
    {
        $bukus = Buku::where('user_id', auth()->id())->get();
    
        // Membuat instansi PDF
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('user.export_buku_pdf', compact('bukus'));
    
        return $pdf->download('data_buku.pdf');
    }
    
}
