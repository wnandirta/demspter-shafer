<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('pages.admin.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $jur = Jurusan::find($request->jurusan_id);
        return view('pages.admin.jurusan.modal', compact('jur'));
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
        $jurusan = Jurusan::find($request->jurusan_id);
        $kode = $jurusan->id ?? '';
        $validator = Validator::make($data, [
            'kode_jurusan' => ['required', 'unique:jurusans,kode_jurusan,'.$kode],
            'nama_jurusan' => ['required'],
        ],
        [
            'required'     => 'Harap Diisi!',
            'kode_jurusan.unique' => 'Kode Sudah Digunakan',
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        if (!$jurusan) {
            $jurusan = Jurusan::create([
                'kode_jurusan' => $request->kode_jurusan,
                'nama_jurusan' => $request->nama_jurusan,
            ]);
        } else {
            $jurusan->update([
                'kode_jurusan' => $request->kode_jurusan,
                'nama_jurusan' => $request->nama_jurusan,
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
        $jurusan = Jurusan::find($id)->delete();
        if ($jurusan) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
