<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karakteristik;
use App\Models\Pengetahuan;
use App\Models\Tipe;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PengetahuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengetahuan = Pengetahuan::all()->groupBy('tipe_id');
        return view('pages.admin.pengetahuan.index', compact('pengetahuan'));
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

    public function showKarakteristik(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            $karakter = Karakteristik::inRandomOrder()->take(5)->get();
            $karakter_list = [];

            foreach ($karakter as $row) {
                $karakter_list[] = ['id' => $row->id, 'text' => $row->kode_karakter.' - '.$row->nama_karakter];
            }

            return response()->json($karakter_list);
        }

        $karakter = Karakteristik::where('kode_karakter', 'like', '%'.$term.'%')
            ->orWhere('nama_karakter', 'like', '%'.$term.'%')
            ->take(5)
            ->get();

        $karakter_list = [];

        foreach ($karakter as $row) {
            $karakter_list[] = ['id' => $row->id, 'text' => $row->kode_karakter.' - '.$row->nama_karakter];
        }

        return response()->json($karakter_list);
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
        $count = count($request->karakteristik_id);

        for ($i=0; $i < $count; $i++) {
            $pengetahuan = Pengetahuan::create([
                'tipe_id'           => $request->tipe_id,
                'karakteristik_id'  => $request->karakteristik_id[$i],
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
        $pengetahuan = Pengetahuan::find($id)->delete();
        if ($pengetahuan) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
