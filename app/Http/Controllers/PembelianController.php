<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PembelianController extends Controller
{
    //
    public function index()
    {
        $pembelian = DB::table('pembelian')
            ->join('karyawans', 'karyawans.id', '=', 'pembelian.karyawan')
            ->groupBy('pembelian.no_faktur')
            ->select('pembelian.*', 'karyawans.nama')
            ->get();
        $data['pembelian'] = $pembelian;
        return view('transaksi.pembelian', $data);
    }

    public function detail($id)
    {
        $pembelian = DB::table('pembelian')
            ->join('barang', 'barang.id_barang', '=', 'pembelian.barang')
            ->select('pembelian.*', 'barang.nama_barang')
            ->where('pembelian.no_faktur', $id)
            ->get();
        $data['pembelian'] = $pembelian;
        $data['no_faktur'] = $id;
        return view('transaksi.detailPembelian', $data);
    }

    public function addPembelianForm()
    {

        $data['barang'] = Barang::all();

        $data['faktur'] = "FP-" . time();
        $supplier = Supplier::all();
        $data['supplier'] = $supplier;
        return view('transaksi.addPembelian', $data);
    }

    public function showData(Request $request)
    {
        $barang = Barang::where('id_barang', $request->barang)->first();
        $nama_barang = $barang['nama_barang'];
        $jumlah_brg = $request->jumlah_stok;
        $harga_jual = str_replace('.', '', $request->harga_sekarang);
        $no_faktur = $request->no_faktur;
        $stok = $request->stok_barang;
        $adj_stok = (int)$stok + (int)$jumlah_brg;

        $obj = new stdClass();
        $obj->nama = $nama_barang;
        $obj->barang = $request->barang;
        $obj->jlh_barang = $jumlah_brg;
        $obj->harga_format = number_format($harga_jual, 0, ',', '.');
        $obj->total_harga_format = number_format(((int) $jumlah_brg * (int) $harga_jual), 0, ',', '.');
        $obj->harga = $harga_jual;
        $obj->total_harga = ((int) $jumlah_brg * (int) $harga_jual);
        $obj->adj_stok = $adj_stok;
        $obj->no_faktur = $no_faktur;
        $array = array();
        array_push($array, $obj);
        return json_decode(json_encode($array));
    }

    public function proses(Request $request)
    {
        $cara_beli = $request->cara_beli;
        $keterangan = $request->keterangan;
        $tgl_pembelian = $request->tgl_pembelian;
        $supplier = $request->supplier;
        foreach ($request->data_pembelian as $data) {
            $barang = Barang::where('id_barang', $data['barang'])->first();
            $stok = $barang['jumlah_stok'];
            $adj_stok = (int) $stok + (int)$data['jumlah'];
            $barang_update = Barang::where('id_barang', $data['barang'])->update([
                "jumlah_stok" => $adj_stok,
                "harga_jual" => $data['harga']
            ]);
            $pembelian = Pembelian::create([
                "no_faktur" => $data['no_faktur'],
                "karyawan" => 1,
                "tgl_beli" => $tgl_pembelian,
                "cara_beli" => $cara_beli,
                "jatuh_tempo" => "",
                "keterangan" => $keterangan,
                "supplier" => $supplier,
                "jumlah" => $data['jumlah'],
                "barang" => $data['barang'],
                "harga_beli" => $data['harga'],
            ]);
        };
        return 200;
    }
}