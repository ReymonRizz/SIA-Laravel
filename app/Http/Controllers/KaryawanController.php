<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        $data['karyawans'] = $karyawans;
        return view('karyawan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['action'] = 'karyawan.store';
        return view('karyawan.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $karyawan = new Karyawan;
        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->telepon = $request->telepon;
        $karyawan->jabatan = $request->jabatan;
        $karyawan->jenis_kelamin = $request->jenis_kelamin;
        $karyawan->save();

        return redirect('/karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit($id = "")
    {
        $karyawan = Karyawan::find($id);
        $data['karyawan'] = $karyawan;
        $data['action'] = 'karyawan/update';
        return view('karyawan.form', $data);
    }
    public function formGaji($id=""){
        
        $karyawan = Karyawan::find($id);
        $data['karyawan'] = $karyawan;
        $data['action'] = 'karyawan/gaji/update';
        return view('karyawan.gaji_form', $data);

    }
   
    public function updateGaji(Request $request){
        
        $karyawan = Karyawan::find($request->id);
        $karyawan->gaji = $request->total_gaji;
        $karyawan->save();
        return redirect('/karyawan');

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $karyawan = Karyawan::find($request->id);
        $karyawan->nama = $request->nama;
        $karyawan->alamat = $request->alamat;
        $karyawan->telepon = $request->telepon;
        $karyawan->save();
        return redirect('/karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return redirect('/karyawan');
    }
}