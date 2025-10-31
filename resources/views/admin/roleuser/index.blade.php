<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($roleuser as $index => $ru)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $ru->user->nama }}</td>
                <td>{{ $ru->user->email }}</td>
                <td>{{ $ru->role->nama_role }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
