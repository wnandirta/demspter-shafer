@extends('layouts.app')

@section('content')
<br>
<br>
<br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <div class="col-6">
                            <h5>Hasil tes</h5>
                        </div>
                        <div class="col-6 button-align-right">
                            <a href="{{ route('siswa.home') }}" class="btn btn-danger btn-sm float-end">Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h5>Analisa Menggunakan Sistem Pakar Metode Dempster Shafer</h5>
                                    <p>Karaktersitik Terpilih:</p>
                                    <ul class="list-unstyled">
                                        @foreach ($idgjl as $li)
                                            <li>- {{ $li->karakteristik->nama_karakter }}</li>
                                        @endforeach
                                    </ul>
                                    <div id="hasil-tes" class="d-none">
                                        @php
                                            unset($m);
                                            $m = [];
                                            unset($barishasil);
                                            unset($nilaihasil);
                                            $barishasil = [];
                                            $nilaihasil = [];
                                        @endphp
                                        @for ($k = 1; $k < count($idgjl); $k++)
                                            <p>Proses ke-{{ $k }}</p>
                                            <p>=============</p>
                                            @if ($k == 1)
                                                @php
                                                    $m[0] = $idgjl[0]->karakteristik->densitas;
                                                    $t[0] = 1 - $idgjl[0]->karakteristik->densitas;
                                                    $m[$k] = $idgjl[$k]->karakteristik->densitas;
                                                    $t[$k] = 1 - $idgjl[$k]->karakteristik->densitas;
                                                @endphp
                                                <ul class="list-unstyled">
                                                    <li>m[0] = {{ $m[0] }}</li>
                                                    <li>t[0] = {{ $t[0] }}</li>
                                                    <li>m[{{ $k }}] = {{ $m[$k] }}</li>
                                                    <li>t[{{ $k }}] = {{ $t[$k] }}</li>
                                                </ul>
                                                @php
                                                    unset($p0);
                                                    $strp0 = '';
                                                    $qbasisgejala = App\Models\Pengetahuan::where('karakteristik_id', $idgjl[0]->karakteristik_id)->get();
                                                    $c = -1;
                                                    foreach ($qbasisgejala as $key => $value) {
                                                        $c++;
                                                        $p0[$c] = $value->tipe->kode_tipe;
                                                        $strp0 = implode(',', $p0);
                                                    }
                                                    unset($p1);
                                                    $strp1 = '';
                                                    $qbasisgejala = App\Models\Pengetahuan::where('karakteristik_id', $idgjl[1]->karakteristik_id)->get();
                                                    $c = -1;
                                                    foreach ($qbasisgejala as $key => $value) {
                                                        $c++;
                                                        $p1[$c] = $value->tipe->kode_tipe;
                                                    }
                                                    $strp1 = implode(',', $p1);
                                                @endphp
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>m1 {{ $strp1 }} = {{ $m[1] }}</td>
                                                        <td>t1 = {{ $t[1] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>m0 = {{ $strp0 }} = {{ $m[0] }}</td>
                                                        <td>@php
                                                            $pp = [];
                                                            $pp = irisan($p0, $p1);
                                                            $strpp = implode(',', $pp);
                                                            echo "$strpp = " . $m[0] * $m[$k];
                                                        @endphp</td>
                                                        <td>{{ $strp0 }} = {{ $m[0] * $t[$k] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>t0 = {{ $t[0] }}</td>
                                                        <td>{{ $strp1 }} = {{ $m[$k] * $t[0] }}</td>
                                                        <td>&oslash; = {{ $t[0] * $t[$k] }}</td>
                                                    </tr>
                                                </table>
                                                @php
                                                    $barishasil[$k][0] = $strpp;
                                                    $barisnilai[$k][0] = $m[0] * $m[$k];

                                                    $barishasil[$k][1] = $strp0;
                                                    $barisnilai[$k][1] = $m[0] * $t[$k];

                                                    $barishasil[$k][2] = $strp1;
                                                    $barisnilai[$k][2] = $m[$k] * $t[0];

                                                    $baristeta[$k] = $t[0] * $t[$k];

                                                    $tetapembagi = 0;
                                                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++) {
                                                        if ($barishasil[$k][$ii] == '') {
                                                            $tetapembagi += $barisnilai[$k][$ii];
                                                        }
                                                    }

                                                    for ($ii = 0; $ii < count($barishasil[$k]); $ii++) {
                                                        for ($jj = $ii + 1; $jj < count($barishasil[$k]); $jj++) {
                                                            if ($barishasil[$k][$ii] == $barishasil[$k][$jj]) {
                                                                $barisnilai[$k][$ii] += $barisnilai[$k][$jj];
                                                                $barishasil[$k][$jj] = '';
                                                            }
                                                        }
                                                    }
                                                @endphp
                                            @else
                                                @php
                                                    $m[$k] = $idgjl[$k]->karakteristik->densitas;
                                                    $t[$k] = 1 - $idgjl[$k]->karakteristik->densitas;
                                                @endphp
                                                <ul class="list-unstyled">
                                                    <li>m[{{ $k }}] = {{ $m[$k] }}</li>
                                                    <li>t[{{ $k }}] = {{ $t[$k] }}</li>
                                                </ul>
                                                @php
                                                    unset($p1);
                                                    $strp1 = '';
                                                    $qbasisgejala = $qbasisgejala = App\Models\Pengetahuan::where('karakteristik_id', $idgjl[$k]->karakteristik_id)->get();
                                                    $c = -1;
                                                    foreach ($qbasisgejala as $key => $value) {
                                                        $c++;
                                                        $p1[$c] = $value->tipe->kode_tipe;
                                                    }
                                                    $strp1 = implode(',', $p1);
                                                @endphp
                                                <ul class="list-unstyled">
                                                    @for ($i = 0; $i < count($barishasil[$k - 1]); $i++)
                                                        <li>{{ $barishasil[$k - 1][$i] }} {{ $barisnilai[$k - 1][$i] }} / (1 -
                                                            {{ $tetapembagi }}) = @php $barisnilai[$k-1][$i] = $barisnilai[$k-1][$i] / (1 - $tetapembagi); @endphp
                                                            {{ $barisnilai[$k - 1][$i] }}</li>
                                                    @endfor
                                                    <li>&oslash; {{ $baristeta[$k - 1] }} / (1 - {{ $tetapembagi }}) =
                                                        @php $baristeta[$k-1] = $baristeta[$k-1] / (1 - $tetapembagi); @endphp {{ $baristeta[$k - 1] }}</li>
                                                </ul>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td>m{{ $k }} {{ $strp1 }} = {{ $m[$k] }}
                                                        </td>
                                                        <td>t{{ $k }} = {{ $t[$k] }}</td>
                                                    </tr>
                                                    @php
                                                        $zz = -1;
                                                    @endphp
                                                    @for ($i = 0; $i < count($barishasil[$k - 1]); $i++)
                                                        @if ($barishasil[$k - 1][$i] != '')
                                                            <tr>
                                                                <td>{{ $barishasil[$k - 1][$i] }} =
                                                                    {{ $barisnilai[$k - 1][$i] }}</td>
                                                                <td>@php
                                                                    unset($pp);
                                                                    $pp = [];
                                                                    $arrh = explode(',', $barishasil[$k - 1][$i]);
                                                                    $pp = irisan($arrh, $p1);
                                                                    $strpp = implode(',', $pp);
                                                                    echo "$strpp = " . $barisnilai[$k - 1][$i] * $m[$k];
                                                                @endphp</td>
                                                                <td>{{ $barishasil[$k - 1][$i] }} =
                                                                    {{ $barisnilai[$k - 1][$i] * $t[$k] }}</td>
                                                            </tr>
                                                            @php
                                                                $zz++;
                                                                $barishasil[$k][$zz] = $strpp;
                                                                $barisnilai[$k][$zz] = $barisnilai[$k - 1][$i] * $m[$k];

                                                                $zz++;
                                                                $barishasil[$k][$zz] = $barishasil[$k - 1][$i];
                                                                $barisnilai[$k][$zz] = $barisnilai[$k - 1][$i] * $t[$k];
                                                            @endphp
                                                        @endif
                                                    @endfor
                                                    @php
                                                        $zz++;
                                                        $barishasil[$k][$zz] = $strp1;
                                                        $barisnilai[$k][$zz] = $m[$k] * $baristeta[$k - 1];

                                                        $baristeta[$k] = $baristeta[$k - 1] * $t[$k];

                                                        $tetapembagi = 0;
                                                        for ($ii = 0; $ii < count($barishasil[$k]); $ii++) {
                                                            if ($barishasil[$k][$ii] == '') {
                                                                $tetapembagi += $barisnilai[$k][$ii];
                                                            }
                                                        }

                                                        for ($ii = 0; $ii < count($barishasil[$k]); $ii++) {
                                                            for ($jj = $ii + 1; $jj < count($barishasil[$k]); $jj++) {
                                                                if ($barishasil[$k][$ii] == $barishasil[$k][$jj]) {
                                                                    $barisnilai[$k][$ii] += $barisnilai[$k][$jj];
                                                                    $barishasil[$k][$jj] = '';
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>teta = {{ $baristeta[$k - 1] }}</td>
                                                        <td>{{ $strp1 }} = {{ $m[$k] * $baristeta[$k - 1] }}</td>
                                                        <td>&oslash; = {{ $baristeta[$k - 1] * $t[$k] }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @endfor
                                        @php
                                            $strp1 = implode(',', $p1);

                                            $arrpenyterbesar = [];
                                            $strpenyterbesar = '';
                                            $nilaipenyterbesar = -1000000;
                                        @endphp
                                        <ul class="list-unstyled">
                                            @for ($i = 0; $i < count($barishasil[$k - 1]); $i++)
                                                <li>{{ $barishasil[$k - 1][$i] }} {{ $barisnilai[$k - 1][$i] }} / (1 -
                                                    {{ $tetapembagi }}) = @php $barisnilai[$k-1][$i] = $barisnilai[$k-1][$i] / (1 - $tetapembagi); @endphp {{ $barisnilai[$k - 1][$i] }}</li>
                                                @if ($nilaipenyterbesar < $barisnilai[$k - 1][$i] && $barishasil[$k - 1][$i] != '')
                                                    @php
                                                        $strpenyterbesar = $barishasil[$k - 1][$i];
                                                        $nilaipenyterbesar = $barisnilai[$k - 1][$i];
                                                    @endphp
                                                @endif
                                            @endfor
                                            <li>&oslash; {{ $baristeta[$k - 1] }} / (1 - {{ $tetapembagi }}) =
                                                @php $baristeta[$k-1] = $baristeta[$k-1] / (1 - $tetapembagi); @endphp {{ $baristeta[$k - 1] }}</li>
                                            @if ($nilaipenyterbesar < $baristeta[$k - 1])
                                                @php
                                                    $strpenyterbesar = '&oslash;';
                                                    $nilaipenyterbesar = $baristeta[$k - 1];
                                                @endphp
                                            @endif
                                        </ul>
                                        <p>TERBESAR => {{ $strpenyterbesar }} = {{ $nilaipenyterbesar }}</p>
                                        <p>==================================</p>
                                        @php
                                            $arrpenyterbesar = explode(',', $strpenyterbesar);
                                            $strhasilpenyakit = '';
                                        @endphp
                                        @for ($i = 0; $i < count($arrpenyterbesar); $i++)
                                            @php
                                                $querypeny = App\Models\Tipe::where('kode_tipe', $arrpenyterbesar[$i])->first();
                                                $hasilTes->user_id  = Auth::user()->id;
                                                $hasilTes->tipe     = $querypeny->nama_tipe;
                                                $hasilTes->nilai    = $nilaipenyterbesar;
                                                $hasilTes->kategori = $querypeny->kategori;
                                                $hasilTes->save();
                                            @endphp
                                            <p>{{ $i + 1 . '. ' . $querypeny->nama_tipe }}</p>
                                            @php
                                                $arrnmpenyterbesar[$i] = $querypeny->nama_tipe;
                                            @endphp
                                            @if ($i == 0)
                                                @php
                                                    $strhasilpenyakit .= $querypeny->nama_tipe;
                                                @endphp
                                            @else
                                                @php
                                                    $strhasilpenyakit .= ', ' . $querypeny->nama_tipe;
                                                @endphp
                                            @endif
                                        @endfor
                                    </div>
                                    <button class="btn btn-success mb-3 btn-show">Lihat Perhitungan</button>
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nilai Probabilitas</th>
                                            <th>Rekomendasi Jurusan</th>
                                        </tr>
                                        <tr>
                                            <td>
                                                @for ($i = 0; $i < count($arrnmpenyterbesar); $i++)
                                                    {{$arrnmpenyterbesar[$i]}}
                                                @endfor
                                            </td>
                                            <td>{{$nilaipenyterbesar}}</td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <th>Tipe Kepribadian</th>
                                            <th>Rekomendasi Jurusan</th>
                                        </tr>
                                        <tr>
                                            <th>Realistic</th>
                                            <th>
                                                <ul>
                                                    <li>
                                                        <li>
                                                        <li>
                                                            <li>
                                                </ul>
                                            </th>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(function () {
        $('.btn-show').click(function (e) {
            e.preventDefault();
            if ($('#hasil-tes').hasClass('d-none')) {
                $('#hasil-tes').removeClass('d-none');
                $('#hasil-tes').addClass('d-block');
            } else {
                $('#hasil-tes').removeClass('d-block');
                $('#hasil-tes').addClass('d-none');
            }
        });
    });
</script>
@endsection
