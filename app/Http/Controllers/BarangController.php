<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    //
    public function index()
    {
        $data["barang"] = Barang::all();
        return view('stok.listBarang', $data);
    }

    public function addBarangForm()
    {
        return view('stok.addBarang');
    }

    public function detailBarangForm($id)
    {
        $data["barang"] = Barang::where('id_barang', $id)->first();
        return view('stok.detailBarang', $data);
    }
    public function editBarangForm($id)
    {
        $data["barang"] = Barang::where('id_barang', $id)->first();
        return view('stok.editBarang', $data);
    }

    public function store(Request $request)
    {
        //    DB::table('users');
        $kode = "BRG";
        $count = Barang::max('id_barang');
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $kode = $kode . $count;
        $barang = Barang::create([
            "kode_barang" => $kode,
            "nama_barang" => $request->nama_barang,
            "jumlah_stok" => $request->jumlah_stok,
            "harga_jual" => $request->harga_jual,
            "harga_beli" => $request->harga_beli
        ]);
        return redirect('/stok-barang');
    }

    public function update(Request $request)
    {
        $barang = Barang::where('id_barang', $request->id_barang)->update([
            "nama_barang" => $request->nama_barang,
            "jumlah_stok" => $request->jumlah_stok,
            "harga_jual" => $request->harga_jual,
            "harga_beli" => $request->harga_beli
        ]);
        return redirect('/stok-barang');
    }
    public function delete($id)
    {
        Barang::where('id_barang', $id)->delete();
        return redirect('/stok-barang');
    }

    public function getData($id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        return $barang;
    }
}