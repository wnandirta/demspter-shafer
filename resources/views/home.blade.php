@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">Tes Minat</div>
                                    <div class="card-body">
                                        <ul>
                                            <li>Minimal pilih 2 pilihan</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('siswa.hasil-tes-user', ['id' => Auth::user()->email, 'kategori' => 'Minat']) }}" class="btn btn-success btn-sm float-start">Hasil Tes</a>
                                        <a href="{{ route('siswa.tes-minat') }}" class="btn btn-primary btn-sm float-end">Mulai Tes</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card">
                                    <div class="card-header">Tes Bakat</div>
                                    <div class="card-body">
                                        <ul>
                                            <li>Minimal pilih 2 pilihan</li>
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <a href="{{ route('siswa.hasil-tes-user', ['id' => Auth::user()->email, 'kategori' => 'Bakat']) }}" class="btn btn-success btn-sm float-start">Hasil Tes</a>
                                        <a href="{{ route('siswa.tes-bakat') }}" class="btn btn-primary btn-sm float-end">Mulai Tes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
