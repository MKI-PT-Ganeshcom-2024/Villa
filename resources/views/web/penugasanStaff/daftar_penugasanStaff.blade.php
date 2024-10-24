@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->

@section('content')
<div class="container">
    <h2>Daftar Penugasan Staff</h2>
    <a href="{{ route('penugasan_staff.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Penugasan</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kamar</th>
                <th>Reservasi</th>
                <th>Layanan</th>
                <th>Staff</th>
                <th>Deskripsi</th>
                <th>Tanggal Penugasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penugasanStaff as $penugasan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $penugasan->kamar ? $penugasan->kamar->nomor_kamar : '-' }}</td>
                    <td>{{ $penugasan->reservasi ? $penugasan->reservasi->nama_tamu : '-' }}</td>
                    <td>{{ $penugasan->layanan ? $penugasan->layanan->nama_layanan : '-' }}</td>
                    <td>{{ $penugasan->user->name }}</td>
                    <td>{{ $penugasan->deskripsi_penugasan }}</td>
                    <td>{{ $penugasan->tgl_penugasan }}</td>
                    <td>{{ $penugasan->status_penugasan }}</td>
                    <td>
                        <a href="{{ route('penugasan_staff.edit', $penugasan->id_penugasan) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('penugasan_staff.destroy', $penugasan->id_penugasan) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
