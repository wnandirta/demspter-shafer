<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('pages.admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
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
        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'min:3'],
            'email'     => ['required', 'email', 'unique:users'],
            'password'  => ['required', 'min:8'],
            'phone'     => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:14'],
        ],
        [
            'required'     => 'Harap Diisi!',
            'min'          => 'Harap Isi Setidaknya :min Karakter',
            'max'          => 'Karakter Lebih Dari :max',
            'email.unique' => 'Email Sudah Digunakan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        if ($user) {
            Toastr::success('Data Disimpan!!','Sukses');
            return redirect()->route('admin.user.index');
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
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
        $user = User::find($id);
        return view('pages.admin.user.update', compact('user'));
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'name'      => ['required', 'string', 'min:3'],
            'email'     => ['required', 'email', 'unique:users,email,'.$id],
            'password'  => ['nullable', 'min:8'],
            'phone'     => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:14'],
        ],
        [
            'required'     => 'Harap Diisi!',
            'min'          => 'Harap Isi Setidaknya :min Karakter',
            'max'          => 'Karakter Lebih Dari :max',
            'email.unique' => 'Email Sudah Digunakan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);

        if ($user) {
            Toastr::success('Data Disimpan!!','Sukses');
            return redirect()->route('admin.user.index');
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        if ($user) {
            Toastr::success('Data Dihapus!!','Sukses');
            return redirect()->back();
        } else {
            Toastr::error('Data Error!!','Error');
            return redirect()->back();
        }
    }
}
