@extends('user.layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Kategori</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user.update_kategori', $kategori->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}" required>
                    </div>
                    <div class="form-group text-right mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
