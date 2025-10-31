<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kategori as $item)
            <tr>
                <td>{{ $item->idkategori }}</td>
                <td>{{ $item->nama_kategori }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
