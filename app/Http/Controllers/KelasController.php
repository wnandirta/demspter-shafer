<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

use DB;
class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guruShows (Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $guru = User::where('role', 'Guru')->where('name', 'LIKE', '%'.$term.'%')->take(5)->get();

        $guru_list = [];

        foreach ($guru as $row) {
            $guru_list[] = ['id' => $row->id, 'text' => $row->name];
        }

        return response()->json($guru_list);

    }
    public function siswaShows (Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $siswa = User::where('role', 'Siswa')->where('name', 'LIKE', '%'.$term.'%')->take(5)->get();

        $siswa_list = [];

        foreach ($siswa as $row) {
            $siswa_list[] = ['id' => $row->id, 'text' => $row->name];
        }

        return response()->json($siswa_list);

    }
    public function index()
    {
        $data = DB::table('kelas as k')
        ->join('users as g', 'g.id', '=', 'k.guru_id')
        ->join('users as s', 's.id', '=', 'k.siswa_id')
        ->select('k.kelas', 'g.name as namaGuru', DB::Raw("GROUP_CONCAT(s.name) as namaSiswa"), DB::Raw("GROUP_CONCAT(k.id) as id"))
        ->groupBy('k.kelas')
        ->get();
        // dd($data);
        return view('pages.guru.kelas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = count($request->siswa_id);
        for ($i=0; $i < $count; $i++) {
            $kelas = Kelas::create([
                'kelas' => $request->kelas,
                'guru_id' => $request->guru_id,
                'siswa_id'  => $request->siswa_id[$i],
            ]);
        }

        Toastr::success('Data Disimpan!!','Sukses');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit(Kelas $kelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas, $id)
    {
        $arr = explode(',', $id);
        $count = count($arr);
        for ($i=0; $i < $count; $i++) { 
            $kelas = Kelas::find($arr[$i]);
            $kelas->delete();
        }
        Toastr::success('Data Dihapus!!','Sukses');

        return redirect()->back();
    }
}
