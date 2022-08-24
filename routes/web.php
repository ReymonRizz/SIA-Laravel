<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BebanController;
use App\Http\Controllers\BukuBesarController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\JurnalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PeralatanController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Models\Peralatan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('master');
    });

    Route::resource('/karyawan', '\App\Http\Controllers\KaryawanController');
    Route::get('karyawan/delete/{id}', '\App\Http\Controllers\KaryawanController@delete');
    Route::post('karyawan/update', '\App\Http\Controllers\KaryawanController@update');
    Route::get('karyawan/gaji/{id}', [KaryawanController::class, 'formGaji']);
    Route::post('karyawan/gaji/update', [KaryawanController::class, 'updateGaji']);


    Route::resource('/supplier', '\App\Http\Controllers\SupplierController');
    Route::get('supplier/delete/{id}', 'SupplierController@delete');
    Route::post('supplier/update', 'SupplierController@update');

    Route::get('/pembelian', [PembelianController::class, 'index']);
    Route::get('/pembelian/add', [PembelianController::class, 'addPembelianForm']);
    Route::get('/pembelian/detail/{id}', [PembelianController::class, 'detail']);
    Route::post('/pembelian/barang/add', [PembelianController::class, 'showData']);
    Route::post('/pembelian/barang/proses', [PembelianController::class, 'proses']);


    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::get('/penjualan/add', [PenjualanController::class, 'addPenjualanForm']);
    Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'detail']);
    Route::post('/penjualan/barang/add', [PenjualanController::class, 'showData']);
    Route::post('/penjualan/proses', [PenjualanController::class, 'create']);
    Route::post('/penjualan/jasa/add', [PenjualanController::class, 'showDataJasa']);


    Route::get('/stok-barang', [BarangController::class, 'index']);
    Route::get('/stok-barang/add', [BarangController::class, 'addBarangForm']);
    Route::post('/barang/add', [BarangController::class, 'store']);
    Route::get('/barang/detail/{id}', [BarangController::class, 'detailBarangForm']);
    Route::get('/barang/edit/{id}', [BarangController::class, 'editBarangForm']);
    Route::post('/barang/update', [BarangController::class, 'update']);
    Route::get('/barang/delete/{id}', [BarangController::class, 'delete']);
    Route::get('/barang/getData/{id}', [BarangController::class, 'getData']);




    Route::get('/jasa', [JasaController::class, 'index']);
    Route::post('/jasa/store', [JasaController::class, 'store']);
    Route::post('/jasa/update', [JasaController::class, 'update']);
    Route::get('/jasa/delete/{id}', [JasaController::class, 'delete']);
    Route::get('/jasa/getData/{id}', [JasaController::class, 'getData']);


    Route::get('/akun', [AkunController::class, 'index']);
    Route::post('/akun/update', [AkunController::class, 'update']);
    Route::post('/akun/add', [AkunController::class, 'store']);
    Route::get('/akun/delete/{id}', [AkunController::class, 'destroy']);


    Route::get('/data-beban', [BebanController::class, 'index']);
    Route::post('/data-beban/add', [BebanController::class, 'store']);
    Route::get('/data-beban/delete/{id}', [BebanController::class, 'delete']);
    Route::post('/data-beban/edit', [BebanController::class, 'edit']);
    Route::get('/data-beban/getNominal', [BebanController::class, 'getNominal']);


    Route::get('/data-peralatan', [PeralatanController::class, 'index']);
    Route::post('/data-peralatan/add', [PeralatanController::class, 'create']);
    Route::get('/data-peralatan/delete/{id}', [PeralatanController::class, 'delete']);
    Route::post('/data-peralatan/edit', [PeralatanController::class, 'edit']);

    // Jurnal
    Route::get('/jurnal/pengeluaran-kas', [JurnalController::class, 'index']);
    Route::get('/jurnal/penerimaan-kas', [JurnalController::class, 'penerimaan']);
    Route::get('/jurnal/penyesuaian', [JurnalController::class, 'penyesuaian']);
    Route::get('/jurnal/umum', [JurnalController::class, 'umum']);
    Route::get('/jurnal/umum/print', [JurnalController::class, 'print_jurnal_umum']);
    Route::get('/jurnal/penutup', [JurnalController::class, 'penutup']);
    Route::get('/jurnal/penutup/print', [JurnalController::class, 'print_jurnal_penutup']);
    Route::post('/jurnal/search/penyesuaian', [JurnalController::class, 'filter_penyesuaian']);
    Route::post('/jurnal/search/pengeluaran', [JurnalController::class, 'filter_pengeluaran']);
    Route::post('/jurnal/search/penerimaan', [JurnalController::class, 'filter_penerimaan']);
    Route::post('/jurnal/search/umum', [JurnalController::class, 'filter_umum']);
    Route::post('/jurnal/search/jurnal-penutup', [JurnalController::class, 'filter_penutup']);

    // Laporan
    Route::get('/laporan/laba-rugi', [LaporanController::class, 'laba_rugi']);
    Route::get('/laporan/laba-rugi/print', [LaporanController::class, 'print_laba_rugi']);
    Route::post('/laporan/search/laba-rugi', [LaporanController::class, 'filter_laba_rugi']);
    Route::get('/laporan/neraca', [LaporanController::class, 'neraca']);
    Route::get('/laporan/neraca/print', [LaporanController::class, 'print_neraca']);
    Route::post('/laporan/search/neraca', [LaporanController::class, 'filter_neraca']);
    Route::get('/laporan/perubahan_modal', [LaporanController::class, 'perubahan_modal']);
    Route::post('/laporan/search/perubahan_modal', [LaporanController::class, 'filter_perubahan_modal']);


    Route::get('/bukubesar', [BukuBesarController::class, 'index']);
    Route::post('/bukubesar/search', [BukuBesarController::class, 'filter_buku_besar']);

    Route::post('/tutupakun', [AkunController::class, 'tutup_akun']);
});
Route::get('/', [LoginController::class, 'login'])->name('login');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');
Route::post('/loginuser', [LoginController::class, 'loginuser']);
Route::post('/logout', [LoginController::class, 'actionlogout'])->name('logout');
