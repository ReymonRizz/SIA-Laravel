<?php

namespace App\Http\Controllers;

use App\Models\Jasa;
use Illuminate\Http\Request;

class JasaController extends Controller
{
    //
    public function index()
    {
        $data['jasa'] = Jasa::all();
        return view('stok.listJasa', $data);
    }

    public function store(Request $request)
    {
        //    DB::table('users');
        $jasa = new Jasa;
        $jasa->kode_jasa = $request->kode_jasa;
        $jasa->nama_jasa = $request->nama_jasa;
        $jasa->harga_jual = $request->harga_jual;
        $jasa->keterangan = $request->keterangan;
        $jasa->save();
        return redirect('/jasa');
    }

    public function update(Request $request)
    {
        $jasa = Jasa::where('id_jasa', $request->id)->update([
            'kode_jasa' => $request->kode_jasa,
            'nama_jasa' => $request->nama_jasa,
            'harga_jual' => $request->harga_jual,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/jasa');
    }

    public function delete($id)
    {
        Jasa::where('id_jasa', $id)->delete();
        return redirect('/jasa');
    }
    public function getData($id)
    {
        $jasa = Jasa::where('id_jasa', $id)->first();
        return $jasa;
    }
}