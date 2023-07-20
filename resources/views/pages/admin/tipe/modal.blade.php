<form id="form-tipe" action="" method="post">
    @csrf
    @method('post')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@if(!$tipe) Tambah @else Edit @endif Tipe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="alert alert-danger" style="display:none"></div>
        <div class="form-group col-12">
            <label for="kode_tipe">Kode</label>
            <input type="hidden" name="tipe_id" value="{{ $tipe ? $tipe->id : '' }}">
            <input type="text" class="form-control @error('kode_tipe') is-invalid @enderror" name="kode_tipe" id="kode_tipe" value="{{ $tipe ? $tipe->kode_tipe : '' }}" placeholder="Masukkan Kode Tipe" required @if($tipe) readonly @endif>
            @error('kode_tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="nama_tipe">Nama Tipe</label>
            <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" name="nama_tipe" id="nama_tipe" value="{{ $tipe ? $tipe->nama_tipe : '' }}" placeholder="Masukkan Nama Tipe" required>
            @error('nama_tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="kategori">Kategori</label>
            <select class="form-control @error('kategori') is-invalid @enderror" name="kategori" id="kategori" placeholder="Masukkan Kode Tipe" required>
                @if (!$tipe)
                <option value="Minat">Minat</option>
                <option value="Bakat">Bakat</option>
                @else
                <option value="Minat" @if($tipe->kategori == 'Minat') selected @endif>Minat</option>
                <option value="Bakat" @if($tipe->kategori == 'Bakat') selected @endif>Bakat</option>
                @endif
            </select>
            @error('kategori')
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
