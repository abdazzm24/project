<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Warna Tanda</th>
            <th>Jenis Kelamin</th>
            <th>Pemilik</th>
            <th>Ras Hewan</th>
            <th>Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pet as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->tanggal_lahir }}</td>
                <td>{{ $p->warna_tanda }}</td>
                <td>{{ $p->jenis_kelamin }}</td>
                <td>{{ $p->pemilik->user->nama }}</td>
                <td>{{ $p->rasHewan->nama_ras }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
