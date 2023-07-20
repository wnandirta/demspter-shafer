@extends('layouts.main')
@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}" placeholder="Enter name" required autofocus>
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $user->email }}" placeholder="Enter email" required>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" name="password" id="password" value="" placeholder="Password">
                                    <span>*kosongkan jika tidak diubah</span>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ $user->phone }}" placeholder="081234567890">
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="Admin" @if($user->role == 'Admin') selected @endif>Admin</option>
                                        <option value="Guru" @if($user->role == 'Guru') selected @endif>Guru</option>
                                        <option value="Siswa" @if($user->role == 'Siswa') selected @endif>Siswa</option>
                                    </select>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="photo">Alamat</label>
                                    <textarea class="form-control" name="address" id="address">{{ $user->address }}</textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer float-right">
                                <a href="" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
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
