<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Beban;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BebanController extends Controller
{
    //
    public function index()
    {
        $data['beban'] = Beban::all();
        $data['akun'] = DB::table('akuns')->where('kode_akun','like','6%')->get();
        return view('transaksilainnya.beban', $data);
    }

    public function store(Request $request)
    {
        //    DB::table('users');
        $kode = "BB-";
        $count = Beban::max('id_beban');
        $count += 1;
        $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        $kode = $kode . $count;
        $beban = new Beban;
        $beban->kode_beban = $kode;
        $beban->tgl_beban = $request->tgl_beban;
        $beban->serba_serbi = $request->serba_serbi;
        $beban->nominal = $request->nominal;
        $beban->keterangan = $request->keterangan;
        $beban->save();
        return redirect('/data-beban');
    }

    public function edit(Request $request)
    {
        $beban = Beban::where('id_beban', $request->id)->update([
            'tgl_beban' => $request->tgl_beban,
            'serba_serbi' => $request->serba_serbi,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/data-beban');
    }

    public function delete($id)
    {
        Beban::where('id_beban', $id)->delete();
        return 200;
    }
    public function getData($id)
    {
        $beban = Beban::where('id_beban', $id)->first();
        return $beban;
    }

    public function getNominal()
    {

        $peralatan = Peralatan::all();
        $total_biaya_penyusutan = 0;
        $today = \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d');

        foreach ($peralatan as $data):
        $date = \Carbon\Carbon::parse($data->tgl_aset);
        $diff = $date->diffInMonths($today);
        $harga = $data->harga_aset ? $data->harga_aset : 0;
        $jumlah_aset = $data->jumlah_aset ? $data->jumlah_aset : 0;
        $total_harga = $data->harga_aset ? $harga * $jumlah_aset : 0;
        $masa_manfaat = (int) $data->masa_manfaat * 12;
        $penyusutan_per_bulan = (int) $total_harga / $masa_manfaat;
        $total_biaya_penyusutan+= $penyusutan_per_bulan;
        endforeach;
        return (int)round($total_biaya_penyusutan);
    }
}
