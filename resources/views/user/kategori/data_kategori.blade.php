@extends('user.layouts.user')

@section('content')
<div class="row justify-content-center">
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
                                    <a href="{{ route('user.tambah_kategori') }}" class="btn btn-primary btn-sm">
                                        Tambahkan Kategori
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
                                            <th class="text-center">Kategori Buku</th>
                                            <th class="text-center">Aksi</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($kategoris->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Silahkan masukkan kategori terlebih dahulu</td>
                                        </tr>
                                        @else
                                        @foreach ($kategoris as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_kategori }}</td>
                                            <td>
                                                <a href="{{ route('user.edit_kategori', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $item->id }}" action="{{ route('user.delete_kategori', $item->id) }}" method="POST" style="display:inline;">
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
        function confirmDelete(kategoriId) {
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
                    document.getElementById('delete-form-' + kategoriId).submit();
                }
            });
        }
    </script>
@endsection
