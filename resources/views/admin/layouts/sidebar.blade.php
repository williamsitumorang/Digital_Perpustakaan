<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
</head>

<body>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-toggler" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
        <a href="{{ route('admin.dashboard_admin') }}" class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-th-large"></i>
            </div>
            <span>Dashboard</span>
        </a>
         <a href="{{ route('admin.data_buku_admin') }}" class="sidebar-item">
            <div class="sidebar-icon">
                <i class="fas fa-cogs"></i>
            </div>
            <span>Data Buku</span>
        </a>
        <a href="#" class="sidebar-item" onclick="confirmLogout(event)">
            <div class="sidebar-icon">
                <i class="fas fa-sign-out-alt"></i>
            </div>
            <span>Logout</span>
        </a>
        <div class="sidebar-footer">
           <Footer>by William Hubertus Pangibulan</Footer>
        </div>
    </div>

    {{-- <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlWAlq6qG7h6juZz0F25pze6GF9WbiwxlVba9xNSpE+86P5XJf0zXnn8t4W" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGfwlok9JM6FAozm6m2fQjAroaMV+maQuyW8W7y9j9ZTjl9XbBf0B5sIWGP" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> <!-- Tambahkan SweetAlert JS -->
    <script src="{{ asset('js/sidebar.js') }}"></script>

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah tautan logout untuk langsung dijalankan

            const url = "{{ route('logout') }}"; // Ambil URL logout

            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url; // Arahkan ke URL logout jika "Ya" dipilih
                }
            });
        }
    </script>
</body>

</html>
