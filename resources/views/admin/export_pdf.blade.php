<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Buku</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori Buku</th>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>File Buku</th>
                <th>Cover Buku</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bukus as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku->judul_buku }}</td>
                    <td>{{ $buku->kategori ? $buku->kategori->nama_kategori : 'Tidak ada' }}</td>
                    <td>{{ $buku->deskripsi }}</td>
                    <td>{{ $buku->jumlah }}</td>
                    <td>
                        <a href="{{ url('uploads/buku/' . $buku->file_buku) }}" target="_blank">Baca</a>
                    </td>
                    <td>
                        <a href="{{ url('uploads/covers/' . $buku->cover_buku) }}" target="_blank">
                            Cover Buku
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
