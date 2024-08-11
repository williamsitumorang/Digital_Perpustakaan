<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Perpustakaan</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

       <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('admin.layouts.sidebar')
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
