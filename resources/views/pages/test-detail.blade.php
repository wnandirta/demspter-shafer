@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <form action="{{ route('siswa.hasil-tes') }}" method="get">
                    <div class="card-header">{{ $title }}</div>

                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                @foreach ($data as $key => $d)
                                <div class="col-6 col-md-4 col-lg-3 mb-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="karakter{{$key}}" name="karakter[]" value="{{ $d->karakteristik->id }}">
                                    <label class="form-check-label" for="karakter{{$key}}"> {{ $d->karakteristik->nama_karakter }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
