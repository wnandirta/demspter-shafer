<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Solusi;
use App\Models\Tipe;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SolusiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solusi = Solusi::all()->groupBy('tipe_id');
        return view('pages.admin.solusi.index', compact('solusi'));
    }

    public function showTipe(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tipe = Tipe::where('kode_tipe', 'like', '%'.$term.'%')
            ->orWhere('nama_tipe', 'like', '%'.$term.'%')
            ->take(5)
            ->get();

        $tipe_list = [];

        foreach ($tipe as $row) {
            $tipe_list[] = ['id' => $row->id, 'text' => $row->kode_tipe.' - '.$row->nama_tipe];
        }

        return response()->json($tipe_list);
    }

    public function showJurusan(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            $jurusan = Jurusan::inRandomOrder()->take(5)->get();
            $jurusan_list = [];

            foreach ($jurusan as $row) {
                $jurusan_list[] = ['id' => $row->id, 'text' => $row->kode_jurusan.' - '.$row->nama_jurusan];
            }

            return response()->json($jurusan_list);
        }

        $jurusan = Jurusan::where('kode_jurusan', 'like', '%'.$term.'%')
            ->orWhere('nama_jurusan', 'like', '%'.$term.'%')
            ->take(5)
            ->get();

        $jurusan_list = [];

        foreach ($jurusan as $row) {
            $jurusan_list[] = ['id' => $row->id, 'text' => $row->kode_jurusan.' - '.$row->nama_jurusan];
        }

        return response()->json($jurusan_list);
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
        $count = count($request->jurusan_id);

        for ($i=0; $i < $count; $i++) {
            $solusi = Solusi::create([
                'tipe_id'           => $request->tipe_id,
                'jurusan_id'  => $request->jurusan_id[$i],
            ]);
        }

        Toastr::success('Data Disimpan!!','Sukses');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $solusi = Solusi::find($id)->delete();
        if ($solusi) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
