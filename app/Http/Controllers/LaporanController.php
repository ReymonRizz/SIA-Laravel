<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class LaporanController extends Controller
{
    //
    public function laba_rugi()
    {
        // $data['beban'] = Beban::all();
        return view('laporan.laba_rugi');
    }

    public function filter_laba_rugi(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
       
        $data_array = array();
        $akun = DB::select("SELECT * FROM akuns ORDER BY kode_akun");

        $penjualan = DB::select(DB::raw("SELECT sum(b.harga_jual) as nominal,sum(b.harga_beli) as nominal_beli, p.jumlah FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian = DB::select(DB::raw("SELECT sum(p.harga_beli) as nominal FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli) BETWEEN 1 AND $bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $beban_penyusutan = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Penyusutan Peralatan Usaha'"));
        $peralatan = DB::select(DB::raw("SELECT sum(harga_aset) as nominal FROM peralatan WHERE MONTH(tgl_aset) BETWEEN 1 AND $bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa = DB::select(DB::raw("SELECT sum(j.harga_jual) as nominal FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun AND p.jasa !=0"));
        foreach ($akun as $akun) {
            $kode_akun = $akun->kode_akun;
            $saldo_awal = $akun->saldo_awal;
            $kas_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah  - $beban_listrik[0]->nominal + $jasa[0]->nominal;
            $pembelian_nominal = $penjualan[0]->nominal_beli * $penjualan[0]->jumlah;
            $penjualan_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah;
            if ($bulan > 1) {
                if ($kode_akun == 1011) {
                    $saldo_awal += $kas_nominal;
                }
                if ($kode_akun == 1103) {
                    $saldo = $akun->saldo_awal;
                    $saldo = $saldo - $pembelian_nominal;
                    $saldo_awal = $saldo;
                }
                if ($kode_akun == 1202) {
                    $saldo_awal += $beban_penyusutan[0]->nominal;
                }
                if ($kode_akun == 2102) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 4101) {
                    $saldo_awal = $penjualan_nominal;
                }
                if ($kode_akun == 4102) {
                    $saldo_awal = $jasa[0]->nominal;
                }

                if ($kode_akun == 6101) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 6102) {
                    $saldo_awal = $beban_listrik[0]->nominal;
                }
                if ($kode_akun == 6103) {
                    $saldo_awal = $beban_penyusutan[0]->nominal;
                }
                if ($kode_akun == 6104) {
                    $saldo_awal = $beban_jasa[0]->nominal;
                }

                if ($kode_akun == 5101) {
                    $saldo_awal = $pembelian_nominal;
                }
            }
            $data = new stdClass();
            $data->kode_akun = $akun->kode_akun;
            $data->nama_akun = $akun->nama_akun;
            $data->saldo_normal = $akun->saldo_normal;
            $data->saldo_awal = $saldo_awal;
            array_push($data_array, $data);
        }
        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $view = view('laporan.table_laba_rugi', [
            "bulan" => $bulan_text,
            "tahun" => $tahun,
            "data" => $data_array
        ])->render();

        return response()->json(['view' => $view]);
    }
    public function print_laba_rugi(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
       
        $data_array = array();
        $akun = DB::select("SELECT * FROM akuns ORDER BY kode_akun");

        $penjualan = DB::select(DB::raw("SELECT sum(b.harga_jual) as nominal,sum(b.harga_beli) as nominal_beli, p.jumlah FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian = DB::select(DB::raw("SELECT sum(p.harga_beli) as nominal FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli) BETWEEN 1 AND $bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $beban_penyusutan = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Penyusutan Peralatan Usaha'"));
        $peralatan = DB::select(DB::raw("SELECT sum(harga_aset) as nominal FROM peralatan WHERE MONTH(tgl_aset) BETWEEN 1 AND $bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa = DB::select(DB::raw("SELECT sum(j.harga_jual) as nominal FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun AND p.jasa !=0"));
        foreach ($akun as $akun) {
            $kode_akun = $akun->kode_akun;
            $saldo_awal = $akun->saldo_awal;
            $kas_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah  - $beban_listrik[0]->nominal + $jasa[0]->nominal;
            $pembelian_nominal = $penjualan[0]->nominal_beli * $penjualan[0]->jumlah;
            $penjualan_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah;
            if ($bulan > 1) {
                if ($kode_akun == 1011) {
                    $saldo_awal += $kas_nominal;
                }
                if ($kode_akun == 1103) {
                    $saldo = $akun->saldo_awal;
                    $saldo = $saldo - $pembelian_nominal;
                    $saldo_awal = $saldo;
                }
                if ($kode_akun == 1202) {
                    $saldo_awal += $beban_penyusutan[0]->nominal;
                }
                if ($kode_akun == 2102) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 4101) {
                    $saldo_awal = $penjualan_nominal;
                }
                if ($kode_akun == 4102) {
                    $saldo_awal = $jasa[0]->nominal;
                }

                if ($kode_akun == 6101) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 6102) {
                    $saldo_awal = $beban_listrik[0]->nominal;
                }
                if ($kode_akun == 6103) {
                    $saldo_awal = $beban_penyusutan[0]->nominal;
                }
                if ($kode_akun == 6104) {
                    $saldo_awal = $beban_jasa[0]->nominal;
                }

                if ($kode_akun == 5101) {
                    $saldo_awal = $pembelian_nominal;
                }
            }
            $data = new stdClass();
            $data->kode_akun = $akun->kode_akun;
            $data->nama_akun = $akun->nama_akun;
            $data->saldo_normal = $akun->saldo_normal;
            $data->saldo_awal = $saldo_awal;
            array_push($data_array, $data);
        }
        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $data = [
            "bulan" => $bulan_text,
            "tahun" => $tahun,
            "data" => $data_array
        ];
        return view('laporan.print_laba_rugi', $data);
    }

    public function neraca(Request $request)
    {
        // $data['beban'] = Beban::all();

        return view('laporan.neraca');
    }

    public function filter_neraca(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $data_array = array();
        $akun = DB::select("SELECT * FROM akuns ORDER BY kode_akun");
        $penjualan = DB::select(DB::raw("SELECT sum(b.harga_jual) as nominal,sum(b.harga_beli) as nominal_beli, p.jumlah FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian = DB::select(DB::raw("SELECT sum(p.harga_beli) as nominal FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli) BETWEEN 1 AND $bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $peralatan = DB::select(DB::raw("SELECT sum(harga_aset) as nominal FROM peralatan WHERE MONTH(tgl_aset) BETWEEN 1 AND $bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa = DB::select(DB::raw("SELECT sum(j.harga_jual) as nominal FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual)  BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun AND p.jasa !=0"));
        foreach ($akun as $akun) {
            $kode_akun = $akun->kode_akun;
            $saldo_awal = $akun->saldo_awal;
            $penjualan_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah ;
            $kas_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah - $beban_listrik[0]->nominal +  $jasa[0]->nominal;
            $pembelian_nominal = $penjualan[0]->nominal_beli * $penjualan[0]->jumlah;
            if ($bulan > 1) {
                if ($kode_akun == 1011) {
                    $saldo_awal += $kas_nominal;
                }
                if ($kode_akun == 1103) {
                    $saldo = $saldo_awal - $pembelian_nominal;
                    $saldo_awal = $saldo;
                }
                if ($kode_akun == 2102) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 4101) {
                    $saldo_awal = $penjualan_nominal;
                }
                if ($kode_akun == 4102) {
                    $saldo_awal = $jasa[0]->nominal;
                }

                if ($kode_akun == 6101) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 6102) {
                    $saldo_awal = $beban_listrik[0]->nominal;
                }
                if ($kode_akun == 6104) {
                    $saldo_awal = $beban_jasa[0]->nominal;
                }

                if ($kode_akun == 5101) {
                    $saldo_awal = $pembelian_nominal;
                }
            }
            $data = new stdClass();
            $data->kode_akun = $akun->kode_akun;
            $data->nama_akun = $akun->nama_akun;
            $data->saldo_normal = $akun->saldo_normal;
            $data->saldo_awal = $saldo_awal;
            if ($kode_akun != 3103) {

                array_push($data_array, $data);
            }
        }

        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $view = view('laporan.table_neraca', [
            "bulan" => $bulan_text,
            "tahun" => $tahun, "akun" => $data_array
        ])->render();
        return response()->json(['view' => $view]);
    }
    public function print_neraca(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $data_array = array();
        $akun = DB::select("SELECT * FROM akuns ORDER BY kode_akun");
        $penjualan = DB::select(DB::raw("SELECT sum(b.harga_jual) as nominal,sum(b.harga_beli) as nominal_beli, p.jumlah FROM penjualan p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_jual) BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun"));
        $pembelian = DB::select(DB::raw("SELECT sum(p.harga_beli) as nominal FROM pembelian p JOIN barang b ON b.id_barang=p.barang WHERE MONTH(p.tgl_beli) BETWEEN 1 AND $bulan AND YEAR(p.tgl_beli) = $tahun"));
        $beban_gaji = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Gaji'"));
        $beban_listrik = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Listrik'"));
        $beban_jasa = DB::select(DB::raw("SELECT sum(nominal) as nominal FROM beban WHERE MONTH(tgl_beban) BETWEEN 1 AND $bulan AND YEAR(tgl_beban) = $tahun AND serba_serbi='Beban Jasa'"));
        $peralatan = DB::select(DB::raw("SELECT sum(harga_aset) as nominal FROM peralatan WHERE MONTH(tgl_aset) BETWEEN 1 AND $bulan AND YEAR(tgl_aset) = $tahun"));
        $jasa = DB::select(DB::raw("SELECT sum(j.harga_jual) as nominal FROM penjualan p JOIN jasa j ON j.id_jasa=p.jasa  WHERE MONTH(p.tgl_jual)  BETWEEN 1 AND $bulan AND YEAR(p.tgl_jual) = $tahun AND p.jasa !=0"));
        foreach ($akun as $akun) {
            $kode_akun = $akun->kode_akun;
            $saldo_awal = $akun->saldo_awal;
            $penjualan_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah ;
            $kas_nominal = $penjualan[0]->nominal * $penjualan[0]->jumlah - $beban_listrik[0]->nominal +  $jasa[0]->nominal;
            $pembelian_nominal = $penjualan[0]->nominal_beli * $penjualan[0]->jumlah;
            if ($bulan > 1) {
                if ($kode_akun == 1011) {
                    $saldo_awal += $kas_nominal;
                }
                if ($kode_akun == 1103) {
                    $saldo = $saldo_awal - $pembelian_nominal;
                    $saldo_awal = $saldo;
                }
                if ($kode_akun == 2102) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 4101) {
                    $saldo_awal = $penjualan_nominal;
                }
                if ($kode_akun == 4102) {
                    $saldo_awal = $jasa[0]->nominal;
                }

                if ($kode_akun == 6101) {
                    $saldo_awal = $beban_gaji[0]->nominal;
                }
                if ($kode_akun == 6102) {
                    $saldo_awal = $beban_listrik[0]->nominal;
                }
                if ($kode_akun == 6104) {
                    $saldo_awal = $beban_jasa[0]->nominal;
                }

                if ($kode_akun == 5101) {
                    $saldo_awal = $pembelian_nominal;
                }
            }
            $data = new stdClass();
            $data->kode_akun = $akun->kode_akun;
            $data->nama_akun = $akun->nama_akun;
            $data->saldo_normal = $akun->saldo_normal;
            $data->saldo_awal = $saldo_awal;
            if ($kode_akun != 3103) {

                array_push($data_array, $data);
            }
        }

        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $data = [
            "bulan" => $bulan_text,
            "tahun" => $tahun, "akun" => $data_array
        ];
        return view('laporan.print_neraca', $data);
    }
    public function perubahan_modal()
    {
        // $data['beban'] = Beban::all();
        return view('laporan.perubahan_modal');
    }

    public function filter_perubahan_modal(Request $request)
    {

        $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $bulan = (int)$request->bulan;
        $bulan_text = $month[$bulan - 1];
        $tahun = $request->tahun;
        $modal = Akun::select("*")->where("kode_akun", "3101 ")->first();
        $view = view('laporan.table_perubahan_modal', [
            'data' => $modal,
            'bulan' => $bulan_text,
            'tahun' => $tahun
        ])->render();

        return response()->json(['view' => $view]);
    }
}
