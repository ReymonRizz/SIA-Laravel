<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Beban;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class JurnalController extends Controller
{
    //
    public function index()
    {
        return view('jurnal.index');
    }

    public function penerimaan()
    {
        return view('jurnal.penerimaan');
    }

    public function penyesuaian()
    {
        return view('jurnal.penyesuaian');
    }

    public function umum()
    {
        return view('jurnal.umum');
    }
    public function penutup()
    {
        return view('jurnal.jurnal_penutup');
    }
    public function filter_pengeluaran(Request $request)
    {
        // $data = $request->bulan . " - " . $request->tahun;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $array = array();
        $data = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban) = $bulan AND YEAR(tgl_beban)=$tahun"));
        foreach ($data as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->kode_beban;
            $obj->tgl = $dt->tgl_beban;
            $obj->ket = $dt->serba_serbi;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli = "";
            $obj->jlh = 1;
            $obj->jenis = "beban";
            array_push($array, $obj);
        }

        $beli = DB::select(DB::raw("SELECT * FROM pembelian WHERE MONTH(tgl_beli) = $bulan AND YEAR(tgl_beli)= $tahun"));
        foreach ($beli as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_beli;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_beli;
            $obj->cara_beli = $dt->cara_beli;
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "beli";
            array_push($array, $obj);
        }
        // $data = "SELECT b.nominal,bl.jumlah_beli,bl.harga_beli FROM pembelian bl INNER JOIN beban b WHERE b.tgl_beban = MONTH($bulan) AND b.tgl_beban=YEAR($tahun) AND bl.tgl_beli = MONTH($bulan) AND b.tgl_beli=YEAR($tahun)";
        $view = view('jurnal.table_jurnal_pengeluaran', [
            'data' => $array
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }

    public function filter_penerimaan(Request $request)
    {
        // $data = $request->bulan . " - " . $request->tahun;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $array = array();
        // $data = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban) = $bulan AND YEAR(tgl_beban)=$tahun"));
        // foreach($data as $dt){
        //     $obj = new stdClass();
        //     $obj->kode = $dt->kode_beban;
        //     $obj->tgl = $dt->tgl_beban;
        //     $obj->ket = $dt->serba_serbi;
        //     $obj->nominal = $dt->nominal;
        //     $obj->cara_beli = "";
        //     $obj->jlh = 1;
        //     $obj->jenis = "beban";
        //     array_push($array,$obj);
        // }

        $penjualan = DB::select(DB::raw("SELECT p.*,b.nama_barang,b.harga_jual,b.harga_beli FROM penjualan p INNER JOIN barang b ON p.barang = b.id_barang WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)= $tahun"));
        foreach ($penjualan as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_jual;
            $obj->cara_jual = $dt->cara_jual;
            $obj->diskon = $dt->diskon;
            $obj->jasa = $dt->jasa;
            $obj->barang = $dt->barang;
            $obj->jlh = $dt->jumlah;
            $obj->harga_beli = $dt->harga_beli;
            array_push($array, $obj);
        };
        $penjualan = DB::select(DB::raw("SELECT p.*,j.nama_jasa,j.harga_jual FROM penjualan p INNER JOIN jasa j ON p.jasa = j.id_jasa WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)= $tahun"));
        foreach ($penjualan as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_jual;
            $obj->cara_jual = $dt->cara_jual;
            $obj->diskon = $dt->diskon;
            $obj->jasa = $dt->jasa;
            $obj->barang = $dt->barang;
            $obj->jlh = $dt->jumlah;
            $obj->harga_beli = $dt->harga_beli ?? 0;
            array_push($array, $obj);
        };
        // $data = "SELECT b.nominal,bl.jumlah_beli,bl.harga_beli FROM pembelian bl INNER JOIN beban b WHERE b.tgl_beban = MONTH($bulan) AND b.tgl_beban=YEAR($tahun) AND bl.tgl_beli = MONTH($bulan) AND b.tgl_beli=YEAR($tahun)";
        $view = view('jurnal.table_jurnal_penerimaan', [
            'data' => $array
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }

    public function filter_penyesuaian(Request $request)
    {
        // $data = $request->bulan . " - " . $request->tahun;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $array = array();
        $data = DB::select(DB::raw("SELECT * FROM beban a, akuns b WHERE MONTH(a.tgl_beban) = $bulan AND YEAR(a.tgl_beban)=$tahun AND b.nama_akun LIKE '%Beban%' GROUP BY kode_beban"));
        // foreach($data as $dt){
        //     $obj = new stdClass();
        //     $obj->kode = $dt->kode_beban;
        //     $obj->tgl = $dt->tgl_beban;
        //     $obj->ket = $dt->serba_serbi;
        //     $obj->nominal = $dt->nominal;
        //     $obj->cara_beli = "";
        //     $obj->jlh = 1;
        //     $obj->jenis = "beban";
        //     array_push($array,$obj);
        // }

        // $array = Beban::all();
        // $data = "SELECT b.nominal,bl.jumlah_beli,bl.harga_beli FROM pembelian bl INNER JOIN beban b WHERE b.tgl_beban = MONTH($bulan) AND b.tgl_beban=YEAR($tahun) AND bl.tgl_beli = MONTH($bulan) AND b.tgl_beli=YEAR($tahun)";
        $view = view('jurnal.table_jurnal_penyesuaian', [
            'data' => $data
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }
    public function filter_umum(Request $request)
    {

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $array = array();
        $data = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli =  $dt->cara_jual;
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Penjualan";
            array_push($array, $obj);
        }
        $hpp = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_beli;
            $obj->cara_beli =  "Tunai";
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Harga Pokok Penjualan";
            array_push($array, $obj);
        }

        $beli = DB::select(DB::raw("SELECT * FROM pembelian WHERE MONTH(tgl_beli) = $bulan AND YEAR(tgl_beli)= $tahun"));
        foreach ($beli as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_beli;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_beli;
            $obj->cara_beli = $dt->cara_beli;
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Pembelian";
            array_push($array, $obj);
        }
        $beban = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban) = $bulan AND YEAR(tgl_beban)= $tahun AND serba_serbi ='Beban Utilitas'"));
        foreach ($beban as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->kode_beban;
            $obj->tgl = $dt->tgl_beban;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli = "Tunai";
            $obj->jlh = 0;
            $obj->jenis = $dt->serba_serbi;
            array_push($array, $obj);
        }
        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $tahun = $request->tahun;
        // $data = "SELECT bl.no_faktur,b.nama_barang,bl.jumlah,bl.harga_beli,bl.cara_beli,bl.keterangan FROM pembelian bl INNER JOIN barang b ON b.id_barang = bl.barang WHERE MONTH(bl.tgl_beli) = '6' AND YEAR(bl.tgl_beli)='2022';";
        $view = view('jurnal.table_jurnal_umum', [
            'data' => $array,
            'bulan' => $bulan_text,
            'tahun' => $tahun
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }



    public function filter_penutup(Request $request)
    {

        $bulan = 12;
        $tahun = $request->tahun;
        $array = array();
        $array_data = array();
        $data_obj = new stdClass();

        $array1 = array();
        $array2 = array();
        $array3 = array();
        $total1 = 0;
        $data = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $total1 += $dt->nominal;
            // array_push($array, $obj);
            // array_push($array1, $obj);
        }
        $data_obj = new stdClass();
        $data_obj->bagian = 'Beban';
        $obj = new stdClass();
        $obj->kode = "Penjualan";
        $obj->tgl = "";
        $obj->ket = "Penjualan";
        $obj->nominal = $total1;
        $obj->cara_beli = "Penjualan";
        $obj->jlh = '';
        $obj->jenis = "Penjualan";
        array_push($array1, $obj);
        $data_obj->bagian = 'Penjualan';
        $data_obj->data = $array1;
        array_push($array_data, $data_obj);

        $total2 = 0;
        $beban = DB::select(DB::raw("SELECT *, sum(nominal) as total FROM `beban` WHERE YEAR(tgl_beban)=$tahun GROUP BY serba_serbi;"));
        foreach ($beban as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->kode_beban;
            $obj->tgl = $dt->tgl_beban;
            $obj->ket = $dt->serba_serbi;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli = "Beban";
            $obj->jlh = '';
            $obj->jenis = "Beban";
            $obj->total = $dt->total;
            array_push($array, $obj);
            array_push($array3, $obj);
            $total2 += $dt->total;
        }
        $data_obj = new stdClass();
        $data_obj->bagian = 'Beban';
        $data_obj->data = $array3;
        array_push($array_data, $data_obj);

        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan_text = $month[$bulan - 1];
        $tahun = $request->tahun;
        // $data = "SELECT bl.no_faktur,b.nama_barang,bl.jumlah,bl.harga_beli,bl.cara_beli,bl.keterangan FROM pembelian bl INNER JOIN barang b ON b.id_barang = bl.barang WHERE MONTH(bl.tgl_beli) = '6' AND YEAR(bl.tgl_beli)='2022';";
        $view = view('jurnal.table_jurnal_penutup', [
            'data' => $array,
            'bulan' => $bulan_text,
            'tahun' => $tahun,
            'array_data' => $array_data
        ])->render();

        return response()->json(['view' => $view]);
        // var_dump($data);
    }


    // Print section
    public function print_jurnal_umum(Request $request)
    {
        $bulan = $request->bulan;;
        $tahun = $request->tahun;
        $array = array();
        $data = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli =  $dt->cara_jual;
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Penjualan";
            array_push($array, $obj);
        }
        $hpp = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE MONTH(p.tgl_jual) = $bulan AND YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_jual;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_beli;
            $obj->cara_beli =  "Tunai";
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Harga Pokok Penjualan";
            array_push($array, $obj);
        }

        $beli = DB::select(DB::raw("SELECT * FROM pembelian WHERE MONTH(tgl_beli) = $bulan AND YEAR(tgl_beli)= $tahun"));
        foreach ($beli as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->no_faktur;
            $obj->tgl = $dt->tgl_beli;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->harga_beli;
            $obj->cara_beli = $dt->cara_beli;
            $obj->jlh = $dt->jumlah;
            $obj->jenis = "Pembelian";
            array_push($array, $obj);
        }
        $beban = DB::select(DB::raw("SELECT * FROM beban WHERE MONTH(tgl_beban) = $bulan AND YEAR(tgl_beban)= $tahun AND serba_serbi ='Beban Utilitas'"));
        foreach ($beban as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->kode_beban;
            $obj->tgl = $dt->tgl_beban;
            $obj->ket = $dt->keterangan;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli = "Tunai";
            $obj->jlh = 0;
            $obj->jenis = $dt->serba_serbi;
            array_push($array, $obj);
        }
        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $tahun = $request->tahun;
        // $data = "SELECT bl.no_faktur,b.nama_barang,bl.jumlah,bl.harga_beli,bl.cara_beli,bl.keterangan FROM pembelian bl INNER JOIN barang b ON b.id_barang = bl.barang WHERE MONTH(bl.tgl_beli) = '6' AND YEAR(bl.tgl_beli)='2022';";
        // $view = view('jurnal.table_jurnal_umum', [
        //     'data' => $array,
        //     'bulan' => $bulan_text,
        //     'tahun' => $tahun
        // ])->render();
        $data = [
            'data' => $array,
            'bulan' => $bulan_text,
            'tahun' => $tahun
        ];
        return view('jurnal.print_jurnal_umum', $data);
    }
    public function print_jurnal_penutup(Request $request)
    {
        $bulan = 12;
        $tahun = $request->tahun;
        $array = array();
        $array_data = array();
        $data_obj = new stdClass();

        $array1 = array();
        $array2 = array();
        $array3 = array();
        $total1 = 0;
        $data = DB::select(DB::raw("SELECT *,b.harga_jual*p.jumlah nominal, b.nama_barang FROM penjualan p INNER JOIN barang b WHERE YEAR(p.tgl_jual)=$tahun AND p.barang = b.id_barang;"));
        foreach ($data as $dt) {
            $total1 += $dt->nominal;
            // array_push($array, $obj);
            // array_push($array1, $obj);
        }
        $data_obj = new stdClass();
        $data_obj->bagian = 'Beban';
        $obj = new stdClass();
        $obj->kode = "Penjualan";
        $obj->tgl = "";
        $obj->ket = "Penjualan";
        $obj->nominal = $total1;
        $obj->cara_beli = "Penjualan";
        $obj->jlh = '';
        $obj->jenis = "Penjualan";
        array_push($array1, $obj);
        $data_obj->bagian = 'Penjualan';
        $data_obj->data = $array1;
        array_push($array_data, $data_obj);

        $total2 = 0;
        $beban = DB::select(DB::raw("SELECT *, sum(nominal) as total FROM `beban` WHERE YEAR(tgl_beban)=$tahun GROUP BY serba_serbi;"));
        foreach ($beban as $dt) {
            $obj = new stdClass();
            $obj->kode = $dt->kode_beban;
            $obj->tgl = $dt->tgl_beban;
            $obj->ket = $dt->serba_serbi;
            $obj->nominal = $dt->nominal;
            $obj->cara_beli = "Beban";
            $obj->jlh = '';
            $obj->jenis = "Beban";
            $obj->total = $dt->total;
            array_push($array, $obj);
            array_push($array3, $obj);
            $total2 += $dt->total;
        }
        $data_obj = new stdClass();
        $data_obj->bagian = 'Beban';
        $data_obj->data = $array3;
        array_push($array_data, $data_obj);

        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan_text = $month[$bulan - 1];
        $tahun = $request->tahun;
        // $data = "SELECT bl.no_faktur,b.nama_barang,bl.jumlah,bl.harga_beli,bl.cara_beli,bl.keterangan FROM pembelian bl INNER JOIN barang b ON b.id_barang = bl.barang WHERE MONTH(bl.tgl_beli) = '6' AND YEAR(bl.tgl_beli)='2022';";
        // $view = view('jurnal.table_jurnal_penutup', [
        //     'data' => $array,
        //     'bulan' => $bulan_text,
        //     'tahun' => $tahun,
        //     'array_data' => $array_data
        // ])->render();
        // $data = "SELECT bl.no_faktur,b.nama_barang,bl.jumlah,bl.harga_beli,bl.cara_beli,bl.keterangan FROM pembelian bl INNER JOIN barang b ON b.id_barang = bl.barang WHERE MONTH(bl.tgl_beli) = '6' AND YEAR(bl.tgl_beli)='2022';";
        // $view = view('jurnal.table_jurnal_umum', [
        //     'data' => $array,
        //     'bulan' => $bulan_text,
        //     'tahun' => $tahun
        // ])->render();
        $data = [
            'data' => $array,
            'bulan' => $bulan_text,
            'tahun' => $tahun,
            'array_data' => $array_data
        ];
        return view('jurnal.print_jurnal_penutup', $data);
    }
}
