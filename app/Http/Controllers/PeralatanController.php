<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    //
    public function index()
    {
        $data['peralatan'] = Peralatan::all();
        return view('transaksilainnya.peralatan', $data);
    }

    public function create(Request $request)
    {
        $peralatan = Peralatan::create([
            "nama_aset" => $request->nama_aset,
            "tgl_aset" => $request->tgl_aset,
            "jumlah_aset" => $request->jumlah_aset,
            "harga_aset" => $request->nominal,
            "masa_manfaat" => $request->masa_manfaat,
            // "keterangan" => $request->keterangan
        ]);

        return redirect('/data-peralatan');
    }

    public function delete($id)
    {
        Peralatan::where("id", $id)->delete();
        return 200;
    }

    public function edit(Request $request)
    {
        $peralatan = Peralatan::where('id', $request->id)->update([
            "nama_aset" => $request->nama_aset,
            "tgl_aset" => $request->tgl_aset,
            "jumlah_aset" => $request->jumlah_aset,
            "harga_aset" => $request->nominal,
            "masa_manfaat" => $request->masa_manfaat,
            // "keterangan" => $request->keterangan
        ]);
        return redirect('/data-peralatan');
    }
}