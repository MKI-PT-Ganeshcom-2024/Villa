@extends($layout)

@section('content')
<div class="container">
    <h2>Tambah Penugasan Staff</h2>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="reservasi-tab" data-bs-toggle="tab" href="#reservasi" role="tab" aria-controls="reservasi" aria-selected="true">Kamar Sudah Direservasi</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="belum-reservasi-tab" data-bs-toggle="tab" href="#belum-reservasi" role="tab" aria-controls="belum-reservasi" aria-selected="false">Kamar Belum Direservasi</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="myTabContent">
        <!-- Form untuk Kamar Sudah Direservasi -->
        <div class="tab-pane fade show active" id="reservasi" role="tabpanel" aria-labelledby="reservasi-tab">
            <form action="{{ route('penugasan_staff.store') }}" method="POST">
                @csrf

                <!-- Select Reservasi -->
                <div class="form-group">
                    <label for="id_reservasi">Reservasi</label>
                    <select class="form-control" id="id_reservasi" name="id_reservasi">
                        <option value="">Pilih Reservasi</option>
                        @foreach($reservasi as $res)
                            <option value="{{ $res->id_reservasi }}">{{ $res->nama_tamu }} - Kamar {{ $res->nomor_kamar }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Layanan -->
                <div class="form-group">
                    <label for="id_layanan">Layanan</label>
                    <select class="form-control" id="id_layanan" name="id_layanan">
                        <option value="">Pilih Layanan</option>
                        @foreach($layanan as $ly)
                            <option value="{{ $ly->id_layanan }}">{{ $ly->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Staff -->
                <div class="form-group">
                    <label for="id">Pilih Staff</label>
                    <select class="form-control" id="id" name="id">
                        <option value="">Pilih Staff</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi Penugasan -->
                <div class="form-group">
                    <label for="deskripsi_penugasan">Deskripsi Penugasan</label>
                    <textarea class="form-control" id="deskripsi_penugasan" name="deskripsi_penugasan" rows="3">{{ old('deskripsi_penugasan') }}</textarea>
                </div>

                <!-- Tanggal Penugasan -->
                <div class="form-group">
                    <label for="tgl_penugasan">Tanggal Penugasan</label>
                    <input type="date" class="form-control" id="tgl_penugasan" name="tgl_penugasan" value="{{ old('tgl_penugasan') }}">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>

        <!-- Form untuk Kamar Belum Direservasi -->
        <div class="tab-pane fade" id="belum-reservasi" role="tabpanel" aria-labelledby="belum-reservasi-tab">
            <form action="{{ route('penugasan_staff.store') }}" method="POST">
                @csrf

                <!-- Select Kamar -->
                <div class="form-group">
                    <label for="id_kamar">Kamar</label>
                    <select class="form-control" id="id_kamar" name="id_kamar">
                        <option value="">Pilih Kamar</option>
                        @foreach($kamar as $kmr)
                            <option value="{{ $kmr->id_kamar }}">Kamar {{ $kmr->nomor_kamar }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select Staff -->
                <div class="form-group">
                    <label for="id">Pilih Staff</label>
                    <select class="form-control" id="id" name="id">
                        <option value="">Pilih Staff</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi Penugasan -->
                <div class="form-group">
                    <label for="deskripsi_penugasan">Deskripsi Penugasan</label>
                    <textarea class="form-control" id="deskripsi_penugasan" name="deskripsi_penugasan" rows="3">{{ old('deskripsi_penugasan') }}</textarea>
                </div>

                <!-- Tanggal Penugasan -->
                <div class="form-group">
                    <label for="tgl_penugasan">Tanggal Penugasan</label>
                    <input type="date" class="form-control" id="tgl_penugasan" name="tgl_penugasan" value="{{ old('tgl_penugasan') }}">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            timer: 3000, // Tampilkan selama 3 detik
            showConfirmButton: false
        });
    </script>
@endif 
@endsection
