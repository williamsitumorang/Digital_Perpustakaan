@extends('user.layouts.user')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Dashboard</h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <p class="card-text">{{ $totalBuku }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Kategori</h5>
                        <p class="card-text">{{ $totalKategori }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku Tersedia</h5>
                        <p class="card-text">{{ $totalBukuTersedia }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Statistik Buku</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="bukuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('bukuChart').getContext('2d');
        const bukuChart = new Chart(ctx, {
            type: 'bar', 
            data: {
                labels: ['Buku 1', 'Buku 2', 'Buku 3'], 
                datasets: [{
                    label: 'Jumlah Buku',
                    data: [12, 19, 3], 
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
