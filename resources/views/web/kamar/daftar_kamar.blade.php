@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Kamar</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            @if (Route::is('kamar.create'))
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a> -> 
                <a href="{{ route('kamar.create') }}" class="text-primary">Tambah Kamar</a>
            @elseif (Route::is('kamar.edit'))
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a> -> 
                <a href="{{ route('kamar.edit', $kamar->id_kamar) }}" class="text-primary">Edit Kamar</a>
            @else
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a>
            @endif
        </span>
    </h2>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('kamar.create') }}" class="btn btn-primary">Tambah Kamar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Foto Kamar</th>
                            <th>Nomor Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kamar->isEmpty()) 
                            <tr>
                                <td colspan="9" class="text-center">Belum Ada Data</td>
                            </tr>
                        @else
                            @foreach ($kamar as $index => $k)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($k->foto_kamar)
                                            <img src="{{ asset('uploads/kamar/' . $k->foto_kamar) }}" alt="Foto Kamar" width="200">
                                        @else
                                            <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $k->nomor_kamar }}</td>
                                    <td>{{ $k->tipe_kamar }}</td>
                                    <td>{{ $k->harga_kamar }}</td>
                                    <td>{{ $k->status_kamar }}</td>
                                    <td>{{ $k->kapasitas_kamar }}</td>
                                    <td>
                                        @foreach ($k->fasilitas as $f)
                                            <span>{{ $f->nama_fasilitas }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('kamar.edit', $k->id_kamar) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('kamar.destroy', $k->id_kamar) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
