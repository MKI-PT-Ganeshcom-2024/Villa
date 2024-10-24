@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->


@section('content')
<div class="container">
    <h2>Edit Penugasan Staff</h2>

    <form action="{{ route('penugasan_staff.update', $penugasanStaff->id_penugasan) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Select Reservasi -->
        <div class="form-group">
            <label for="id_reservasi">Reservasi (Untuk Kamar Yang Sudah Direservasi)</label>
            <select class="form-control" id="id_reservasi" name="id_reservasi">
                <option value="">Pilih Reservasi</option>
                @foreach($reservasi as $res)
                    <option value="{{ $res->id_reservasi }}" {{ $penugasanStaff->id_reservasi == $res->id_reservasi ? 'selected' : '' }}>
                        {{ $res->nama_tamu }} - Kamar {{ $res->nomor_kamar }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select Kamar -->
        <div class="form-group">
            <label for="id_kamar">Kamar (Untuk Kamar Yang Belum Direservasi)</label>
            <select class="form-control" id="id_kamar" name="id_kamar">
                <option value="">Pilih Kamar</option>
                @foreach($kamar as $kmr)
                    <option value="{{ $kmr->id_kamar }}" {{ $penugasanStaff->id_kamar == $kmr->id_kamar ? 'selected' : '' }}>
                        Kamar {{ $kmr->nomor_kamar }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select Layanan -->
        <div class="form-group">
            <label for="id_layanan">Layanan</label>
            <select class="form-control" id="id_layanan" name="id_layanan">
                <option value="">Pilih Layanan</option>
                @foreach($layanan as $ly)
                    <option value="{{ $ly->id_layanan }}" {{ $penugasanStaff->id_layanan == $ly->id_layanan ? 'selected' : '' }}>
                        {{ $ly->nama_layanan }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select Staff -->
        <div class="form-group">
            <label for="id">Pilih Staff</label>
            <select class="form-control" id="id" name="id">
                <option value="">Pilih Staff</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $penugasanStaff->id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Deskripsi Penugasan -->
        <div class="form-group">
            <label for="deskripsi_penugasan">Deskripsi Penugasan</label>
            <textarea class="form-control" id="deskripsi_penugasan" name="deskripsi_penugasan" rows="3">{{ $penugasanStaff->deskripsi_penugasan }}</textarea>
        </div>

        <!-- Tanggal Penugasan -->
        <div class="form-group">
            <label for="tgl_penugasan">Tanggal Penugasan</label>
            <input type="date" class="form-control" id="tgl_penugasan" name="tgl_penugasan" value="{{ $penugasanStaff->tgl_penugasan }}">
        </div>

        <!-- Status Penugasan -->
        <div class="form-group">
            <label for="status_penugasan">Status Penugasan</label>
            <select class="form-control" id="status_penugasan" name="status_penugasan">
                <option value="ditugaskan" {{ $penugasanStaff->status_penugasan == 'ditugaskan' ? 'selected' : '' }}>Ditugaskan</option>
                <option value="selesai" {{ $penugasanStaff->status_penugasan == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
