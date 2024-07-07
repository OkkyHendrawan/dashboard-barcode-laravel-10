<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NBI</th>
            <th>Dibuat Pada</th>
            <th>Diperbarui Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach($home as $home)
            <tr>
                <td>{{ $home->id }}</td>
                <td>{{ $home->nama }}</td>
                <td>{{ $home->nbi }}</td>
                <td>{{ $home->created_at }}</td>
                <td>{{ $home->updated_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
