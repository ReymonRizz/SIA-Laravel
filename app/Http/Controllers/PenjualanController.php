<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Jasa;
use App\Models\Penjualan;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PenjualanController extends Controller
{
    //
    public function index()
    {
        $penjualan = DB::table('penjualan')
            ->join('karyawans', 'karyawans.id', '=', 'penjualan.karyawan')
            ->groupBy('penjualan.no_faktur')
            ->select('penjualan.*', 'karyawans.nama')
            ->get();
        $data['penjualan'] = $penjualan;
        return view('transaksi.penjualan', $data);
    }
    public function addPenjualanForm()
    {
        $data['barang'] = Barang::all();
        $data['jasa'] = Jasa::all();
        $supplier = Supplier::all();
        $data['supplier'] = $supplier;
        $data['faktur'] = "FJ-" . time();
        return view('transaksi.addPenjualan', $data);
    }
    public function detail($id)
    {
        $penjualan = DB::table('penjualan')
            ->leftJoin('barang', 'barang.id_barang', '=', 'penjualan.barang')
            ->leftJoin('jasa', 'jasa.id_jasa', '=', 'penjualan.jasa')
            ->select('penjualan.*', 'barang.nama_barang', 'barang.harga_jual','jasa.nama_jasa','jasa.harga_jual as harga_jasa')
            ->where('penjualan.no_faktur', $id)
            ->get();
        $data['penjualan'] = $penjualan;
        $data['no_faktur'] = $id;
        return view('transaksi.detailPenjualan', $data);
    }


    public function showdata(Request $request)
    {
        $barang = Barang::where('id_barang', $request->barang)->first();
        $nama_barang = $barang['nama_barang'];
        $jumlah_brg = $request->jlh_barang;
        $diskon_jual = str_replace('.', '', $request->diskon_jual);
        $obj = new stdClass();
        $obj->nama = $nama_barang;
        $obj->jlh_barang = $jumlah_brg;
        $obj->stok_barang = $barang['jumlah_stok'];
        $obj->harga_format = number_format(str_replace('.', '', $request->harga_jual), 0, ',', '.');
        $obj->total_harga_format = number_format(((int) $jumlah_brg * (int) str_replace('.', '', $request->harga_jual)) - (int) $diskon_jual, 0, ',', '.');
        $obj->diskon_format = number_format($diskon_jual, 0, ',', '.');
        $obj->harga = str_replace('.', '', $request->harga_jual);
        $obj->total_harga = ((int) $jumlah_brg * (int) str_replace('.', '', $request->harga_jual)) - (int) $diskon_jual;
        $obj->diskon = $diskon_jual;
        $obj->barang = $request->barang;
        $obj->no_faktur = $request->no_faktur;
        $array = array();
        array_push($array, $obj);
        return json_decode(json_encode($array));
    }

    public function create(Request $request)
    {
        $cara_jual = $request->cara_jual;
        $keterangan = $request->keterangan;
        $tgl_jual = $request->tgl_jual;
        $customer = $request->customer;
        foreach ($request->data_penjualan as $jual) {
            if ($jual['jenis_jual'] == 'Barang') {
                $barang = Barang::where('id_barang', $jual['barang'])->first();
                $nama_barang = $barang['nama_barang'];
                $jumlah_brg = $jual['jumlah'];
                $diskon_jual = str_replace('.', '', $jual['diskon']);
                $stok = $jual['stok_barang'];
                $adj_stok = (int)$stok - (int)$jumlah_brg;

                $barang_update = Barang::where('id_barang', $jual['barang'])->update([
                    "jumlah_stok" => $adj_stok
                ]);
                $penjualan = Penjualan::create([
                    "no_faktur" => $jual['no_faktur'],
                    "karyawan" => 1,
                    "tgl_jual" => $tgl_jual,
                    "cara_jual" => $cara_jual,
                    "jatuh_tempo" => "",
                    "keterangan" => $keterangan,
                    "customer" => $customer,
                    "jumlah" => $jual['jumlah'],
                    "diskon" => str_replace('.', '', $diskon_jual),
                    "barang" => $jual['barang'],
                    "jasa" => 0,
                ]);
            }
            if ($jual['jenis_jual'] == 'Jasa') {
                $jasa = Jasa::where('id_jasa', $jual['jasa'])->first();
                $nama_jasa = $jasa['nama_jasa'];
                $jumlah = $jual['jumlah'];
                $diskon_jual = 0;

                $penjualan = Penjualan::create([
                    "no_faktur" => $jual['no_faktur'],
                    "karyawan" => 1,
                    "tgl_jual" => $tgl_jual,
                    "cara_jual" => $cara_jual,
                    "jatuh_tempo" => "",
                    "keterangan" => $keterangan,
                    "customer" => $customer,
                    "jumlah" => $jumlah,
                    "diskon" => $diskon_jual,
                    "barang" => 0,
                    "jasa" => $jual['jasa'],
                ]);
            }
        }


        return 200;
    }

    public function showDataJasa(Request $request)
    {
        $jasa = Jasa::where('id_jasa', $request->jasa)->first();
        $nama_jasa = $jasa['nama_jasa'];
        $jumlah = $request->jumlah_jasa;
        $diskon_jual = 0;
        $obj = new stdClass();
        $obj->nama = $nama_jasa;
        $obj->jumlah = $jumlah;
        $obj->harga_format = number_format(str_replace('.', '', $request->harga_jasa), 0, ',', '.');
        $obj->total_harga_format = number_format(((int) $jumlah * (int) str_replace('.', '', $request->harga_jasa)) - (int) $diskon_jual, 0, ',', '.');
        $obj->diskon_format = number_format($diskon_jual, 0, ',', '.');
        $obj->harga = str_replace('.', '', $request->harga_jasa);
        $obj->total_harga = ((int) $jumlah * (int) str_replace('.', '', $request->harga_jasa)) - (int) $diskon_jual;
        $obj->diskon = $diskon_jual;
        $obj->jasa = $request->jasa;
        $obj->no_faktur = $request->no_faktur;
        $array = array();
        array_push($array, $obj);
        return json_decode(json_encode($array));
    }

    public function createJasa(Request $request)
    {
        $jasa = Jasa::where('id_jasa', $request->jasa)->first();
        $nama_jasa = $jasa['nama_jasa'];
        $jumlah = $request->jumlah_jasa;
        $diskon_jual = 0;
        $penjualan = new Penjualan;
        $penjualan->no_faktur = $request->no_faktur;
        $penjualan->karyawan = 1;
        $penjualan->tgl_jual = date('Y-m-d');
        $penjualan->cara_jual = "";
        $penjualan->jatuh_tempo = "";
        $penjualan->keterangan = "";
        $penjualan->customer = "";
        $penjualan->jumlah = $jumlah;
        $penjualan->diskon = $diskon_jual;
        $penjualan->jasa = $request->jasa;
        $penjualan->barang = 0;
        $penjualan->save();
    }
}
