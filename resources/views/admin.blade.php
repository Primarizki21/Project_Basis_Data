<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manajemen Pengaduan</title>
</head>
<body>
    <h1>Admin - Manajemen Pengaduan</h1>

    {{-- Flash Message --}}
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelapor</th>
                <th>Kategori Kekerasan</th>
                <th>Tanggal Kejadian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengaduan as $p)
            <tr>
                <td>{{ $p->pengaduan_id }}</td>
                <td>{{ $p->pelapor }}</td>
                <td>{{ $p->kategori_kekerasan }}</td>
                <td>{{ $p->tanggal_kejadian }}</td>
                <td>{{ $p->status_pengaduan }}</td>
                <td>
                    <a href="{{ route('pengaduan.show', $p->pengaduan_id) }}">Detail</a> |
                    <a href="{{ route('pengaduan.edit', $p->pengaduan_id) }}">Edit</a> |
                    <form action="{{ route('pengaduan.destroy', $p->pengaduan_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus pengaduan ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6">Belum ada pengaduan</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
