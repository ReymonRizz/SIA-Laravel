<?php

namespace App\Http\Controllers;

use App\Models\BebanPeralatan;
use Illuminate\Http\Request;

class BebanPeralatanController extends Controller
{
    //
    public function index()
    {
        $data['beban_peralatan'] = BebanPeralatan::all();
        return view('transaksilainnya.peralatan', $data);
    }

    public function store(Request $request)
    {
        //    DB::table('users');
        $bebanperalatan = new BebanPeralatan;
        $bebanperalatan->nama_peralatan = $request->nama_peralatan;
        $bebanperalatan->tanggal_pembelian = $request->tanggal_pembelian;
        $bebanperalatan->jumlah = $request->jumlah;
        $bebanperalatan->harga = $request->harga;
        $bebanperalatan->total_harga = $request->total_harga;
        $bebanperalatan->masa_manfaat = $request->masa_manfaat;
        $bebanperalatan->penyusutan_perbulan = $request->penyusutan_perbulan;
        $bebanperalatan->nilai_buku = $request->nilai_buku;
        $bebanperalatan->save();
        return redirect('/bebanperalatan');
    }

    public function update(Request $request)
    {
        $bebanperalatan = BebanPeralatan::where('id_bebanperalatan', $request->id)->update([
            'nama_beban' => $request->nama_beban,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total_harga' => $request->total_harga,
            'masa_manfaat' => $request->masa_manfaat,
            'penyusutan_perbulan' => $request->penyusutan_perbulan,
            'nilai_buku' => $request->nilai_buku,
        ]);
        return redirect('/bebanperalatan');
    }

    public function delete($id)
    {
        BebanPeralatan::where('id_bebanperalatan', $id)->delete();
        return redirect('/bebanperalatan');
    }
    public function getData($id)
    {
        $bebanperalatan = BebanPeralatan::where('id_bebanperalatan', $id)->first();
        return $bebanperalatan;
    }
}