@extends($layout)

@section('content')
<div class="card-header py-3">
    <h1 class="h3 mb-2 text-gray-800">Tambah Fasilitas</h1>
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
</div>    
<div class="container-fluid">
    <br>
    <form action="{{ route('fasilitas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('fasilitas.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection


