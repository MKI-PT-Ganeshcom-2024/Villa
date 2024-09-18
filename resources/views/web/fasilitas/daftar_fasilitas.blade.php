@extends($layout)

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Fasilitas</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            @if (Route::is('fasilitas.create'))
                <a href="{{ route('fasilitas.index') }}" class="text-primary">Fasilitas</a> -> 
                <a href="{{ route('fasilitas.create') }}" class="text-primary">Tambah Fasilitas</a>
            @elseif (Route::is('fasilitas.edit'))
                <a href="{{ route('fasilitas.index') }}" class="text-primary">Fasilitas</a> -> 
                <a href="{{ route('fasilitas.edit', $fasilitas->id_fasilitas) }}" class="text-primary">Edit Fasilitas</a>
            @else
                <a href="{{ route('fasilitas.index') }}" class="text-primary">Fasilitas</a>
            @endif
        </span>
    </h2>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('fasilitas.create') }}" class="btn btn-primary">Tambah Fasilitas</a>
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($fasilitas->isEmpty()) 
                            <tr>
                                <td colspan="9" class="text-center">Belum Ada Data</td>
                            </tr>
                    @else
                        @foreach ($fasilitas as $f)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $f->nama_fasilitas }}</td>
                                <td>
                                    <a href="{{ route('fasilitas.edit', $f->id_fasilitas) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('fasilitas.destroy', $f->id_fasilitas) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Hapus</button>
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

    <table class="table table-bordered">

        
    </table>
@endsection
