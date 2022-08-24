<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use stdClass;

class BukuBesarController extends Controller
{
    //
    public function index()
    {
        return view('bukubesar.index');
    }
    public function filter_buku_besar(Request $request)
    {
        // $data = $request->bulan . " - " . $request->tahun;
        $tahun = $request->tahun;
        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = $request->bulan;
        $data = array();
        $akun = DB::select(DB::raw("SELECT * FROM akuns ORDER BY kode_akun"));
        $penjualan = DB::select(DB::raw("SELECT * FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual)=$bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian = DB::select(DB::raw("SELECT * FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli)=$bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban)=$bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban)=$bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban)=$bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $peralatan = DB::select(DB::raw("SELECT * FROM peralatan WHERE MONTH(tgl_aset)=$bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa = DB::select(DB::raw("SELECT * FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual)=$bulan AND YEAR(p.tgl_jual) = $tahun AND jasa !=0"));

        $penjualan_total = DB::select(DB::raw("SELECT sum(b.harga_jual) as nominal, sum(b.harga_beli) as nominal_beli, p.jumlah FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian_total = DB::select(DB::raw("SELECT sum(p.harga_beli) as nominal FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli) BETWEEN 1 AND $bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji_total = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik_total = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa_total = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $peralatan_total = DB::select(DB::raw("SELECT sum(harga_aset) as nominal FROM peralatan WHERE MONTH(tgl_aset) BETWEEN 1 AND $bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa_total = DB::select(DB::raw("SELECT sum(j.harga_jual) as nominal FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun AND p.jasa !=0"));
        $obj = new stdClass();
        $akun_array= array();
        foreach($akun as $akun){
            $kode_akun = $akun->kode_akun;
            $saldo_awal = $akun->saldo_awal;
            $penjualan_nominal = $penjualan_total[0]->nominal * $penjualan_total[0]->jumlah + $jasa_total[0]->nominal - $beban_listrik_total[0]->nominal;
            $pembelian_nominal = $penjualan_total[0]->nominal_beli * $penjualan_total[0]->jumlah;
            if ($bulan > 1) {
                if ($kode_akun == 1011) {
                    $saldo_awal += $penjualan_nominal;
                }
                if ($kode_akun == 1103) {
                    $saldo = $akun->saldo_awal;
                    $saldo = $saldo - $pembelian_nominal;
                    $saldo_awal = $saldo;
                }
                if ($kode_akun == 2102) {
                    $saldo_awal = $beban_gaji_total[0]->nominal;
                }
                if ($kode_akun == 4101) {
                    $saldo_awal = $penjualan_nominal;
                }
                if ($kode_akun == 4102) {
                    $saldo_awal = $jasa_total[0]->nominal;
                }

                if ($kode_akun == 6101) {
                    $saldo_awal = $beban_gaji_total[0]->nominal;
                }
                if ($kode_akun == 6102) {
                    $saldo_awal = $beban_listrik_total[0]->nominal;
                }
                if ($kode_akun == 6104) {
                    $saldo_awal = $beban_jasa_total[0]->nominal;
                }

                if($kode_akun ==5101){
                    $saldo_awal = $pembelian_nominal;
                }
            }

            $obj_data = new stdClass();
            $obj_data->saldo_awal = $saldo_awal;
            $obj_data->saldo_normal = $akun->saldo_normal;  
            $obj_data->kode_akun = $akun->kode_akun;
            $obj_data->nama_akun = $akun->nama_akun;
            array_push($akun_array,$obj_data);
        }
        $obj->bagian = "akun";
        $obj->data = $akun_array;
        $obj->penjualan = $penjualan;
        $obj->pembelian = $pembelian;
        $obj->beban_gaji = $beban_gaji;
        $obj->beban_listrik = $beban_listrik;
        $obj->beban_jasa = $beban_jasa;
        $obj->peralatan = $peralatan;
        $obj->jasa = $jasa;
        array_push($data,$obj);
        
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $view = view('bukubesar.table_buku_besar', [
            'data' => $data,
            'bulan' => $bulan_text,
            'tahun' => $tahun
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }
}
