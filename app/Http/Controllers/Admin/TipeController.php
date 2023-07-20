<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tipe;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipe = Tipe::all();
        return view('pages.admin.tipe.index', compact('tipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipe = Tipe::find($request->tipe_id);
        return view('pages.admin.tipe.modal', compact('tipe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $tipe = Tipe::find($request->tipe_id);
        $kode = $tipe->id?? '';
        $validator = Validator::make($data, [
            'kode_tipe' => ['required', 'unique:tipes,kode_tipe,'.$kode],
            'nama_tipe' => ['required'],
        ],
        [
            'required'     => 'Harap Diisi!',
            'kode_tipe.unique' => 'Kode Sudah Digunakan',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        if (!$tipe) {
            $tipe = Tipe::create([
                'kode_tipe' => $request->kode_tipe,
                'nama_tipe' => $request->nama_tipe,
                'kategori' => $request->kategori,
            ]);
        } else {
            $tipe->update([
                'kode_tipe' => $request->kode_tipe,
                'nama_tipe' => $request->nama_tipe,
                'kategori' => $request->kategori,
            ]);
        }
        Toastr::success('Data Disimpan!!','Sukses');
        return response()->json(['success'=>'Data Tersimpan']);
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
        $tipe = Tipe::find($id)->delete();
        if ($tipe) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
