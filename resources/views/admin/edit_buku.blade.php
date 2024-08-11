@extends('admin.layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Buku</h3>
            </div>
            <div class="card-body">
                <!-- Menampilkan file buku yang ada -->
                <div class="form-group mt-3">
                    <label>File Buku Saat Ini:</label><br>
                    @if($buku->file_buku)
                        <a href="{{ asset('uploads/buku/' . $buku->file_buku) }}" target="_blank">{{ $buku->file_buku }}</a>
                    @else
                        <span>Tidak ada file buku.</span>
                    @endif
                </div>

                <!-- Menampilkan cover buku yang ada -->
                <div class="form-group mt-3">
                    <label>Cover Buku Saat Ini:</label><br>
                    @if($buku->cover_buku)
                        <img src="{{ asset('uploads/covers/' . $buku->cover_buku) }}" alt="Cover Buku" style="width: 150px; height: auto;">
                    @else
                        <span>Tidak ada cover buku.</span>
                    @endif
                </div>

                <form action="{{ route('admin.update_buku', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $buku->judul_buku }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kategori_buku">Kategori Buku</label>
                        <select class="form-control" id="kategori_buku" name="kategori_buku" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $buku->kategori_buku == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ $buku->deskripsi }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $buku->jumlah }}" required min="1">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file_buku">Upload File Buku (PDF) (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" class="form-control-file" id="file_buku" name="file_buku" accept=".pdf">
                    </div>

                    <div class="form-group mt-3">
                        <label for="cover_buku">Upload Cover Buku (JPEG/JPG/PNG) (Kosongkan jika tidak ingin mengganti)</label>
                        <input type="file" class="form-control-file" id="cover_buku" name="cover_buku" accept=".jpeg,.jpg,.png">
                    </div>

                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
