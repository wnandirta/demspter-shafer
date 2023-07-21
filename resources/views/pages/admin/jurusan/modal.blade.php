<form id="form-jurusan" action="" method="post">
    @csrf
    @method('post')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@if(!$jur) Tambah @else Edit @endif jurusan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="form-group col-12">
            <label for="kode_jurusan">Kode</label>
            <input type="hidden" name="jurusan_id" value="{{ $jur ? $jur->id : '' }}">
            <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" name="kode_jurusan" id="kode_jurusan" value="{{ $jur ? $jur->kode_jurusan : '' }}" placeholder="Masukkan Kode Jurusan" required @if($jur) readonly @endif>
            @error('kode_jurusan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="nama_jurusan">Nama Jurusan</label>
            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" name="nama_jurusan" id="nama_jurusan" value="{{ $jur ? $jur->nama_jurusan : '' }}" placeholder="Masukkan Nama Jurusan" required>
            @error('nama_jurusan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary btn-simpan" onclick="saveData();">Simpan</button>
    </div>
</form>
