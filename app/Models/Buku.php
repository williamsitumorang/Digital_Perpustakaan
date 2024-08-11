<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'kategori_buku',
        'deskripsi',
        'jumlah',
        'file_buku',
        'cover_buku',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_buku'); // 'kategori_buku' adalah nama kolom yang menyimpan ID kategori
    }
}
