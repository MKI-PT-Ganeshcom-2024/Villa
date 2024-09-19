<!-- Modal for Edit Fasilitas -->
<div class="modal fade" id="editFasilitasModal{{ $f->id_fasilitas }}" tabindex="-1" role="dialog" aria-labelledby="editFasilitasModalLabel{{ $f->id_fasilitas }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFasilitasModalLabel{{ $f->id_fasilitas }}">Edit Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('fasilitas.update', $f->id_fasilitas) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nama Fasilitas</label>
                        <input type="text" name="nama_fasilitas" class="form-control" value="{{ $f->nama_fasilitas }}" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
                </form>
        </div>
    </div>
</div>