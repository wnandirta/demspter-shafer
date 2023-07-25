<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Karakteristik;
use App\Models\Pengetahuan;
use App\Models\Tipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Auth::user()->role == 'Admin') {
        //     $siswa = User::where('role', 'Siswa')->count();
        //     $guru = User::where('role', 'Guru')->count();
        //     $minat = Tipe::where('kategori', 'Minat')->count();
        //     $bakat = Tipe::where('kategori', 'Bakat')->count();
        //     $karakter = Karakteristik::count();
        //     return view('pages.admin.dashboard', compact('siswa', 'guru', 'minat', 'bakat', 'karakter'));
        // } else if (Auth::user()->role == 'Guru') {
        //     $siswa = User::where('role', 'Siswa')->count();
        //     $minat = Tipe::where('kategori', 'Minat')->count();
        //     $bakat = Tipe::where('kategori', 'Bakat')->count();
        //     return view('pages.guru.dashboard', compact('siswa', 'minat', 'bakat'));
        // } 
        if (Auth::user()->role != 'Siswa') {
            $siswa = User::where('role', 'Siswa')->count();
            $guru = User::where('role', 'Guru')->count();
            $minat = Tipe::where('kategori', 'Minat')->count();
            $bakat = Tipe::where('kategori', 'Bakat')->count();
            $karakter = Karakteristik::count();
            $kelasArr = DB::table('kelas as k')
            ->select('k.kelas', DB::Raw("GROUP_CONCAT(k.siswa_id) as idSiswa"))
            ->groupBy('k.kelas')
            ->get();
            $kelas = count($kelasArr);
            // dd($kelas);
            return view('pages.admin.dashboard', compact('siswa','kelas', 'guru', 'minat', 'bakat', 'karakter'));
        }
        else if (Auth::user()->role == 'Siswa') {
            return view('home');
        }
    }

    public function tesMinat(Request $request)
    {
        $title = 'Tes Minat';
        $data = Pengetahuan::whereHas('tipe', function ($q) {
            $q->where('kategori', 'Minat');
        })
        ->get();
        return view('pages.test-detail', compact('title', 'data'));
    }

    public function tesBakat(Request $request)
    {
        $title = 'Tes Bakat';
        $data = Pengetahuan::whereHas('tipe', function ($q) {
            $q->where('kategori', 'Bakat');
        })
        ->get();
        return view('pages.test-detail', compact('title', 'data'));
    }

    public function hasilTes(Request $request)
    {
        if ($request->karakter) {
            $idgjl = Pengetahuan::whereHas('karakteristik', function ($q) use($request) {
                $q->whereIn('id', $request->karakter);
            })
            ->get();
            $hasilTes = new Hasil();
            return view('pages.hasil-test', compact('idgjl', 'hasilTes'));
        } else {
            return redirect()->back()->with('error', 'Harap pilih!!');
        }
    }

    public function hasilTesUser(Request $request, $id)
    {
        $user = User::where('email', $id)->first();
        $hasil = Hasil::where('user_id', $user->id)->where('kategori', $request->kategori)->get();
        return view('pages.list-hasil', compact('user', 'hasil'));
    }

}
