<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karakteristik;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KarakteristikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karakteristik = Karakteristik::all();
        return view('pages.admin.karakteristik.index', compact('karakteristik'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $kar = Karakteristik::find($request->karakter_id);
        return view('pages.admin.karakteristik.modal', compact('kar'));
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
        $karakteristik = Karakteristik::find($request->karakter_id);
        $kode = $karakteristik->id ?? '';
        $validator = Validator::make($data, [
            'kode_karakter' => ['required', 'unique:karakteristiks,kode_karakter,'.$kode],
            'nama_karakter' => ['required'],
            'densitas' => ['required'],
        ],
        [
            'required'     => 'Harap Diisi!',
            'kode_karakter.unique' => 'Kode Sudah Digunakan',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        if (!$karakteristik) {
            $karakteristik = Karakteristik::create([
                'kode_karakter' => $request->kode_karakter,
                'nama_karakter' => $request->nama_karakter,
                'densitas' => $request->densitas,
            ]);
        } else {
            $karakteristik->update([
                'kode_karakter' => $request->kode_karakter,
                'nama_karakter' => $request->nama_karakter,
                'densitas' => $request->densitas,
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
        $karakteristik = Karakteristik::find($id)->delete();
        if ($karakteristik) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
