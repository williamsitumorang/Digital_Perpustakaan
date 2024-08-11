@extends('user.layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambahkan Buku</h3>
            </div>
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            <div class="card-body">
                <form action="{{ route('user.store_buku') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul_buku">Judul Buku</label>
                        <input type="text" class="form-control" id="judul_buku" name="judul_buku" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="kategori_buku">Kategori Buku</label>
                        <select class="form-control" id="kategori_buku" name="kategori_buku" required>
                            <option value="">Pilih Kategori</option>
                            @if($kategoris->isEmpty())
                                <option disabled>Silahkan masukkan kategori terlebih dahulu</option>
                            @else
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" required min="1">
                    </div>

                    <div class="form-group mt-3">
                        <label for="file_buku">Upload File Buku (PDF)</label>
                        <input type="file" class="form-control-file" id="file_buku" name="file_buku" accept=".pdf" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="cover_buku">Upload Cover Buku (JPEG/JPG/PNG)</label>
                        <input type="file" class="form-control-file" id="cover_buku" name="cover_buku" accept=".jpeg,.jpg,.png" required>
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