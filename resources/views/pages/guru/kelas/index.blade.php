@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Kelas</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.kelas.store') }}" method="post" >
                                @csrf
                                @method('post')
                                <div class="row mb-3">
                                    <div class="form-group col-12 col-md-4">
                                        <label for="">Kelas </label>
                                        <input type="text" name="kelas" class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="guru_id">Guru</label>
                                        <select id="guru_id" name="guru_id" class="form-control" data-placeholder="Pilih Guru" style="width: 100%;" required></select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="siswa_id">Siswa</label>
                                        <select id="siswa_id" name="siswa_id[]" class="form-control" multiple="multiple" data-placeholder="Pilih Siswa" style="width: 100%;" required></select>
                                    </div>
                                    <div class="form-group col-12 col-md-4">
                                        <label for="kode_jurusan">Aksi</label><br>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="{{ route('admin.kelas.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </form>
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelas</th>
                                        <th>Guru</th>
                                        <th>Siswa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; $count = count($data); ?>
                                    @if ($count > 0)
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$item->kelas}}</td>
                                            <td>{{$item->namaGuru}}</td>
                                            <td>{{$item->namaSiswa}}</td>
                                            <td>
                                                <a href="kelas-delete/{{$item->id}}" class="btn btn-danger btn-xs">Hapus</a>
                                                {{-- <button type="submit" class="btn btn-danger btn-xs">Hapus</button> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">Data Belum Ada</td>
                                    </tr>

                                    @endif
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
            $('#guru_id').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('admin.show-guru') }}",
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

            $('#siswa_id').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('admin.show-siswa') }}",
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
