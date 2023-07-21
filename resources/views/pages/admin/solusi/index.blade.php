@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel solusi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.solusi.store') }}" method="post" >
                                @csrf
                                @method('post')
                                <div class="row mb-3">
                                    <div class="form-group col-12 col-md-4">
                                        <label for="tipe_id">Tipe</label>
                                        <select id="tipe_id" name="tipe_id" class="form-control" data-placeholder="Pilih Tipe" style="width: 100%;" required></select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="jurusan_id">Jurusan</label>
                                        <select id="jurusan_id" name="jurusan_id[]" class="form-control" multiple="multiple" data-placeholder="Pilih jurusan" style="width: 100%;" required></select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="kode_jurusan">Aksi</label><br>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('admin.solusi.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </form>
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe</th>
                                        <th>Jurusan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solusi as $key => $row)
                                    @php
                                        $tipe = App\Models\Tipe::find($key);
                                    @endphp
                                        <tr>
                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                            <td class="align-middle">{{ $tipe->kode_tipe }} - {{ $tipe->nama_tipe }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach ($row as $k)
                                                    <li class="list-group-item text-left">{{ $k->jurusan->kode_jurusan }} - {{ $k->jurusan->nama_jurusan }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach ($row as $aksi)
                                                    <li class="list-group-item text-center">
                                                        <form onsubmit="return confirm('Apakah Anda Yakin?')"
                                                            action="{{ route('admin.solusi.destroy', $aksi->id) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                                        </form>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#tipe_id').select2({
                theme: 'bootstrap4',
                minimumInputLength: 2,
                ajax: {
                    url: "{{ route('admin.show-tipe') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            })

            $('#jurusan_id').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('admin.show-jurusan') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            })
        });
    </script>
@endsection
