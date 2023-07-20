<form id="form-karakter" action="" method="post">
    @csrf
    @method('post')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@if(!$kar) Tambah @else Edit @endif Karakteristik</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="form-group col-12">
            <label for="kode_karakter">Kode</label>
            <input type="hidden" name="karakter_id" value="{{ $kar ? $kar->id : '' }}">
            <input type="text" class="form-control @error('kode_karakter') is-invalid @enderror" name="kode_karakter" id="kode_karakter" value="{{ $kar ? $kar->kode_karakter : '' }}" placeholder="Masukkan Kode Karakteristik" required @if($kar) readonly @endif>
            @error('kode_karakter')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="nama_karakter">Nama Karaktersitik</label>
            <input type="text" class="form-control @error('nama_karakter') is-invalid @enderror" name="nama_karakter" id="nama_karakter" value="{{ $kar ? $kar->nama_karakter : '' }}" placeholder="Masukkan Nama Karaktersitik" required>
            @error('nama_karakter')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="densitas">Densitas</label>
            <input type="number" step="0.01" class="form-control @error('densitas') is-invalid @enderror" name="densitas" id="densitas" value="{{ $kar ? $kar->densitas : '' }}" placeholder="Masukkan Densitas" required>
            @error('densitas')
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
