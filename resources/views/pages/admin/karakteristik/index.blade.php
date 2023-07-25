@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Karakteristik</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <button type="button" class="btn btn-success btn-sm mb-3 btn-tambah">Tambah Karakteristik</button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Densitas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karakteristik as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->kode_karakter }}</td>
                                            <td>{{ $row->nama_karakter }}</td>
                                            <td>{{ $row->densitas }}</td>
                                            <td>
                                                <form onsubmit="return confirm('Apakah Anda Yakin?')"
                                                    action="{{ route('guru.karakteristik.destroy', $row->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="javascript:void(0)" class="btn btn-info btn-sm btn-tambah" data-id="{{ $row->id }}">Edit</a>
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
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
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.btn-tambah').click(function(e) {
            e.preventDefault();
            var karakter_id = $(this).data('id');
            $.ajax({
                type: "GEt",
                url: "{{ route('guru.karakteristik.create') }}",
                data: {
                    karakter_id: karakter_id,
                },
                cache: false,
                success: function(response) {
                    $('.modal-content').html(response);
                    $('#exampleModal').modal('show');
                }
            });
        });
        function saveData() {
            var data = new FormData($('#form-karakter')[0])
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('guru.karakteristik.store') }}",
                method: 'post',
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.btn-simpan').attr('disabled', true);
                },
                success: function(result) {
                    $('.btn-simpan').removeAttr('disabled');
                    if (result.errors) {
                        $('.alert-danger').html('');

                        $.each(result.errors, function(key, value) {
                            $('.alert-danger').show();
                            $('.alert-danger').append('<li>' + value + '</li>');
                        });
                    } else {
                        window.location.reload();
                        $('.alert-danger').hide();
                        $('#form-karakter').trigger('reset');
                        $('#exampleModal').modal('hide');
                    }
                }
            });
        }
    </script>
@endsection
