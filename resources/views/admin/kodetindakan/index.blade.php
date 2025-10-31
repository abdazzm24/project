<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kode</th>
            <th>Deskripsi Tindakan Terapi</th>
            <th>Nama Kategori</th>
            <th>Nama Kategori Klinis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kodeTindakan as $index => $item)
            <tr>
                <td>{{ $item->idkode_tindakan_terapi }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                <td>{{ $item->kategori->nama_kategori ?? '' }}</td>
                <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? ''  }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
