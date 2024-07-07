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
                <td><img src="{{ asset('gambar-wisata/' . $tiket->gambar) }}" alt="Gambar Tiket" style="max-width: 100px;"></td>
                <td>{{ $tiket->nama_wisata }}</td>
                <td>Rp {{ number_format($tiket->harga_tiket, 2, ',', '.') }}</td>
                <td>{{ $tiket->created_at }}</td>
                <td>{{ $tiket->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
