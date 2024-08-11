@extends('user.layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambahkan Kategori Buku</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.store_kategori') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul_buku">Kategori Buku</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection