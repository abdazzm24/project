<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Ras Hewan</th>
            <th>Jenis Hewan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rasHewan as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $r->nama_ras }}</td>
                <td>{{ $r->jenisHewan->nama_jenis_hewan }}</td>
            </tr>
        @endforeach
    </tbody>