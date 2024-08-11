@extends('user.layouts.user')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                 <!-- Notifikasi -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-tools d-flex justify-content-between">
                                    <a href="{{ route('user.tambah_buku') }}" class="btn btn-primary btn-sm">
                                        Tambahkan Buku
                                    </a>

                                    <form method="GET" action="{{ route('user.data_buku') }}" class="form-inline">
                                        <div class="form-group mr-2">
                                            <select name="kategori_id" class="form-control" onchange="this.form.submit()">
                                                <option value="">Semua Kategori</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>

                                    <a href="{{ route('user.export.buku.pdf') }}" class="btn btn-success btn-sm">
                                        Export PDF
                                    </a>

                                    <div class="input-group input-group-sm" style="width: 200px;">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead class="text-center">
                                        <tr class="text-center">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Judul Buku</th>
                                            <th class="text-center">Kategori Buku</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">File Buku</th>
                                            <th class="text-center">Cover Buku</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($bukus->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Silahkan masukkan buku terlebih dahulu</td>
                                        </tr>
                                        @else
                                        @foreach ($bukus as $index => $buku)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $buku->judul_buku }}</td>
                                            <td>{{ $buku->kategori ? $buku->kategori->nama_kategori : 'Kategori tidak tersedia' }}</td>
                                            <td>{{ $buku->deskripsi }}</td>
                                            <td>{{ $buku->jumlah }}</td>
                                            <td>
                                                <a href="{{ asset('uploads/buku/' . $buku->file_buku) }}" target="_blank" class="btn btn-primary btn-sm" style="width: 100px; font-size: 14px;">
                                                    Baca
                                                </a>
                                            </td>                                            
                                            <td>
                                                <img src="{{ asset('uploads/covers/' . $buku->cover_buku) }}" alt="Cover Buku" style="width: 160px; height: 180px;">
                                            </td>
                                            <td>
                                                <a href="{{ route('user.edit', $buku->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $buku->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $buku->id }}" action="{{ route('user.delete_buku', $buku->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(bukuId) {
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus buku ini?',
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi, kirim form hapus
                document.getElementById('delete-form-' + bukuId).submit();
            }
        });
    }
</script>
@endsection
