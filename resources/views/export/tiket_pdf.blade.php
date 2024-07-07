<!DOCTYPE html>
<html>
<head>
    <title>Data Tiket</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .gambar-wisata {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <h2>Data Tiket</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar Wisata</th>
                <th>Nama Wisata</th>
                <th>Harga Tiket</th>
                <th>Dibuat Pada</th>
                <th>Diperbarui Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tiket as $tiket)
                <tr>
                    <td>{{ $tiket->id }}</td>
                    <td><img src="{{ public_path('gambar-wisata/' . $tiket->gambar) }}" alt="Gambar Wisata" class="gambar-wisata"></td>
                    <td>{{ $tiket->nama_wisata }}</td>
                    <td>Rp {{ number_format($tiket->harga_tiket, 2, ',', '.') }}</td>
                    <td>{{ $tiket->created_at->format('d-m-Y') }}</td>
                    <td>{{ $tiket->updated_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
